<?php
/*
 * Plugin Name:WooCommerce iyzico checkout form Payment Gateway
 * Plugin URI: https://www.kahvedigital.com
 * Description: iyzico Payment gateway for woocommerce
 * Version: 1.0.6
 * Author: KahveDigital
 * Author URI: http://kahvedigital.com
 * Domain Path: /i18n/languages/
 */

if (!defined('ABSPATH')) {
    exit;
}
define('API_URL_FORM', 'https://api.iyzipay.com');
global $iyzico_db_version;
$iyzico_db_version = '1.0';

register_deactivation_hook(__FILE__, 'iyzico_deactivation');
register_activation_hook(__FILE__, 'iyzico_activate');
add_action('plugins_loaded', 'iyzico_update_db_check');

function iyzico_update_db_check() {
    global $iyzico_db_version;
    global $wpdb;

    $installed_ver = get_option("iyzico_db_version");

    if ($installed_ver != $iyzico_db_version) {
        iyzico_update();
    }
}

function iyzico_update() {
    global $iyzico_db_version;
    update_option("iyzico_db_version", $iyzico_db_version);
}

function iyzico_activate() {

    global $wpdb;
    global $iyzico_db_version;
    $iyzico_db_version = '1.0';
    $table_name = $wpdb->prefix . 'iyzico_checkout_form_user';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		customer_id int NOT NULL,
		card_key VARCHAR(50),
		iyzico_api VARCHAR(100),
		PRIMARY KEY  (id)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
    $table_name2 = $wpdb->prefix . 'iyzico_order_refunds';
    $sql = "CREATE TABLE $table_name2 (
		iyzico_order_refunds_id INT(11) NOT NULL AUTO_INCREMENT,
		order_id INT(11) NOT NULL,
		item_id INT(11) NOT NULL,
		payment_transaction_id INT(11) NOT NULL,
		paid_price VARCHAR(50),
		total_refunded VARCHAR(50),
		PRIMARY KEY  (iyzico_order_refunds_id)
	) $charset_collate;";
    dbDelta($sql);

    add_option('iyzico_db_version', $iyzico_db_version);
}

function iyzico_deactivation() {
    global $wpdb;
    global $iyzico_db_version;

    $table_name = $wpdb->prefix . 'iyzico_checkout_form_user';
    $table_name2 = $wpdb->prefix . 'iyzico_order_refunds';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "DROP TABLE IF EXISTS $table_name;";
    $wpdb->query($sql);
    $sql = "DROP TABLE IF EXISTS $table_name2;";
    $wpdb->query($sql);
    delete_option('iyzico_db_version');
    flush_rewrite_rules();
}

function iyzico_install_data() {
    global $wpdb;
}

add_action('plugins_loaded', 'woocommerce_iyzico_checkout_from_init', 0);

function woocommerce_iyzico_checkout_from_init() {
    if (!class_exists('WC_Payment_Gateway'))
        return;

    class WC_Gateway_Iyzicocheckoutform extends WC_Payment_Gateway {

        public function __construct() {
            $this->id = 'iyzicocheckoutform';
            $this->method_title = __('iyzico Checkout form', 'iyzico-woocommerce-checkout-form');
            $this->method_description = __('You can get your API ID and Secret key values from https://merchant.iyzipay.com/settings.', 'iyzico-woocommerce-checkout-form');
            $this->icon = plugins_url('/iyzico-payment-module/assets/img/cards.png', dirname(__FILE__));
            $this->has_fields = false;
            $this->order_button_text = __('Proceed to iyzico checkout', 'iyzico-woocommerce-checkout-form');
            $this->supports = array('products', 'refunds');

            $this->init_form_fields();

            $this->init_settings();

            $this->title = $this->settings['title'];
            $this->enabled = $this->settings['enabled'];
            $this->description = $this->settings['description'];
            $this->form_class = $this->settings['form_class'];

            $this->api_id = $this->settings['live_form_api_id'];
            $this->secret_key = $this->settings['live_form_secret_key'];

            add_action('init', array(&$this, 'check_iyzicocheckoutform_response'));
            add_action('woocommerce_api_wc_gateway_iyzicocheckoutform', array($this, 'check_iyzicocheckoutform_response'));

            add_action('admin_notices', array($this, 'checksFields'));
            if (version_compare(WOOCOMMERCE_VERSION, '2.0.0', '>=')) {
                add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
            } else {
                add_action('woocommerce_update_options_payment_gateways', array($this, 'process_admin_options'));
            }


            add_action('woocommerce_receipt_iyzicocheckoutform', array($this, 'receipt_page'));

            if (!$this->is_valid_for_use()) {
                $this->enabled = 'no';
            }
        }

        function checksFields() {
            global $woocommerce;

            if ($this->enabled == 'no')
                return;
        }

        function init_form_fields() {
            $this->form_fields = array(
                'enabled' => array(
                    'title' => __('Enable/Disable', 'iyzico-woocommerce-checkout-form'),
                    'label' => __('Enable iyzico checkout', 'iyzico-woocommerce-checkout-form'),
                    'type' => 'checkbox',
                    'default' => 'yes'
                ),
                'title' => array(
                    'title' => __('Title', 'iyzico-woocommerce-checkout-form'),
                    'type' => 'text',
                    'description' => __('This message will show to the user during checkout.', 'iyzico-woocommerce-checkout-form'),
                    'default' => 'Online Ödeme'
                ),
                'description' => array(
                    'title' => __('Description', 'iyzico-woocommerce-checkout-form'),
                    'type' => 'text',
                    'description' => __('This controls the description which the user sees during checkout.', 'iyzico-woocommerce-checkout-form'),
                    'default' => __('Pay with your credit card via iyzico.', 'iyzico-woocommerce-checkout-form'),
                    'desc_tip' => true,
                ),
                'live_form_api_id' => array(
                    'title' => __('Live Merchant API ID', 'iyzico-woocommerce-checkout-form'),
                    'type' => 'text'
                ),
                'live_form_secret_key' => array(
                    'title' => __('Live Merchant Secret Key', 'iyzico-woocommerce-checkout-form'),
                    'type' => 'text'
                ),
                'form_class' => array(
                    'title' => __('Form Class', 'iyzico-woocommerce-checkout-form'),
                    'type' => 'select',
                    'default' => 'popup',
                    'options' => array('popup' => __('Popup', 'iyzico-woocommerce-checkout-form'), 'responsive' => __('Responsive', 'iyzico-woocommerce-checkout-form'))
                ),
            );
        }

        function is_valid_for_use() {
     
            return true;
        }

        public function admin_options() {
            if ($this->is_valid_for_use()) {
                parent::admin_options();
            } else {
                ?>
                <div class="inline error"><p><strong><?php _e('Gateway Disabled', 'iyzico-woocommerce-checkout-form'); ?></strong>: <?php _e('iyzico Checkout does not support your store currency.', 'iyzico-woocommerce-checkout-form'); ?></p></div>
                <?php
            }
        }

        function receipt_page($order) {
            global $woocommerce;

            $message = '<p>' . __('Thank you for your order, please click the button below to pay with iyzico Checkout.', 'iyzico-woocommerce-checkout-form') . '</p>';

            $response = $this->generate_iyzicocheckoutform_form($order);

            if (is_object($response) && 'success' == $response->getStatus()) {
                echo $message;
                $response = $response->getCheckoutFormContent();
                echo ' <div id="iyzipay-checkout-form" class="' . $this->form_class . '">' . $response . '</div>';
            } else if (is_object($response) && $response->getStatus() == 'failure') {
                echo $message;
                $response = $response->getErrorMessage();
                wc_add_notice(__($response, 'iyzico-woocommerce-checkout-form'), 'error');
            } else {
                wc_add_notice(__($response, 'iyzico-woocommerce-checkout-form'), 'error');
            }
        }

        function process_refund($order_id, $amount = null, $reason = '') {
            global $wpdb;

            $order = new WC_Order($order_id);
            $totalorder = $order->get_total();
            if ($totalorder == $amount) {
                require_once 'IyzipayBootstrap.php';

                $table_name = $wpdb->prefix . 'iyzico_order_refunds';
                $rows = $wpdb->get_results("SELECT * FROM $table_name WHERE order_id=$order_id");
                foreach ($rows as $row) {
                    $item_id = $row->item_id;
                    $payment_transaction_id = $row->payment_transaction_id;
                    $paid_price = $row->paid_price;

                    IyzipayBootstrap::init();
                    $options = new \Iyzipay\Options();
                    $options->setApiKey($this->api_id);
                    $options->setSecretKey($this->secret_key);
                    $options->setBaseUrl(API_URL_FORM);

                    $request = new \Iyzipay\Request\CreateRefundRequest();
                    $locale = \Iyzipay\Model\Locale::EN;
                    $siteLang = explode('_', get_locale());
                    $locale = ($siteLang[0] == "tr") ? Iyzipay\Model\Locale::TR : Iyzipay\Model\Locale::EN;
                    $request->setLocale($locale);
                    $request->setConversationId(uniqid($order_id) . "_refund_{$order_id}_{$item_id}");
                    $request->setPaymentTransactionId($payment_transaction_id);
                    $request->setPrice($paid_price);
                    $request->setCurrency($order->get_order_currency());
                    $request->setIp($_SERVER['REMOTE_ADDR']);
                    $response = \Iyzipay\Model\Refund::create($request, $options);

                    if ($response->getStatus() == "failure") {
                        update_post_meta($order_id, 'refunded_item', json_encode(array(
                            'api_request'               => $request->toJsonString(),
                            'api_response'              => esc_sql($response->getRawResult()),
                            'processing_timestamp'      => date('Y-m-d H:i:s', $response->getSystemTime() / 1000),
                            'transaction_status'        => esc_sql($response->getStatus()),
                            'created'                   => date('Y-m-d H:i:s'),
                            'note'                      => esc_sql($response->getErrorMessage()),
                        )));

                        return false;
                    } else {
                        $wpdb->update(
                                $table_name, array(
                            'total_refunded' => $paid_price,
                                ), array('item_id' => $item_id, 'order_id' => $order_id)
                        );
                        update_post_meta($order_id, 'refunded_item_' . $item_id, json_encode(array(
                            'api_request' => $request->toJsonString(),
                            'api_response' => esc_sql($response->getRawResult()),
                            'processing_timestamp' => date('Y-m-d H:i:s', $response->getSystemTime() / 1000),
                            'transaction_status' => esc_sql($response->getStatus()),
                            'created' => date('Y-m-d H:i:s'),
                            'note' => esc_sql($response->getErrorMessage()),
                        )));
                    }
                }
                return true;
            } else {
                $order->add_order_note(__('Please use the iyzico panel for partial refund. iyzico Panel link https://merchant.iyzipay.com/login', 'iyzico-woocommerce-checkout-form'));
			return new WP_Error( 'broke', __( "Please use the iyzico panel for partial refund. iyzico Panel link https://merchant.iyzipay.com/login", "iyzico-woocommerce-checkout-form" ) );
			return false;
            
            }
        }

        function generate_iyzicocheckoutform_form($order_id) {
            global $woocommerce;
            $iyzico_gateway = new iyzicocheckoutformGateway($this->settings, $order_id);
            $api_response = $iyzico_gateway->generatePaymentToken();
            return $api_response;
        }

        function process_payment($order_id) {
            $order = new WC_Order($order_id);

            if (version_compare(WOOCOMMERCE_VERSION, '2.1.0', '>=')) {
                /* 2.1.0 */
                $checkout_payment_url = $order->get_checkout_payment_url(true);
            } else {
                /* 2.0.0 */
                $checkout_payment_url = get_permalink(get_option('woocommerce_pay_page_id'));
            }

            return array(
                'result' => 'success',
                'redirect' => add_query_arg(
                        'order', $order->id, add_query_arg(
                                'key', $order->order_key, $checkout_payment_url
                        )
                )
            );
        }

        function check_iyzicocheckoutform_response() {            
            global $wpdb;
            global $woocommerce;
            $order_id = '';
            $response = array();
            $siteLanguage = get_locale();

            try {
                require_once 'IyzipayBootstrap.php';

                $token = $_POST['token'];


                if (empty($token)) {
                    throw new \Exception("Token not found");
                }

                IyzipayBootstrap::init();

                $options = new \Iyzipay\Options();
                $options->setApiKey($this->api_id);
                $options->setSecretKey($this->secret_key);
                $options->setBaseUrl(API_URL_FORM);

                $siteLang = explode('_', get_locale());
                $locale = ($siteLang[0] == "tr") ? Iyzipay\Model\Locale::TR : Iyzipay\Model\Locale::EN;

                $request = new \Iyzipay\Request\RetrieveCheckoutFormRequest();
                $request->setLocale($locale);
                $request->setToken($token);

                $response = \Iyzipay\Model\CheckoutForm::retrieve($request, $options);


                if (empty($_REQUEST['wc-api']) || (!empty($_REQUEST['wc-api']) && 'WC_Gateway_Iyzicocheckoutform' !== $_REQUEST['wc-api'])) {
                    throw new \Exception('Invalid request');
                }

                $api_response = esc_sql($response->getStatus());
                if (empty($api_response) || 'success' != $api_response) {
                    throw new \Exception($response->getErrorMessage());
                }

                $payment_status = esc_sql($response->getPaymentStatus());
                if (empty($api_response) || 'SUCCESS' != $payment_status) {
                    throw new \Exception($response->getErrorMessage());
                }

                $token = esc_sql($response->getToken());
                if (empty($token)) {
                    throw new \Exception("Invalid Token");
                }

                $transaction_object = esc_sql($response->getBasketId());
                $order = new WC_Order($response->getBasketId());

                update_post_meta($transaction_object, 'get_auth', json_encode(array(
                    'api_request' => esc_sql($request->toJsonString()),
                    'api_response' => esc_sql($response->getRawResult()),
                    'processing_timestamp' => date('Y-m-d H:i:s', $response->getSystemTime() / 1000),
                    'transaction_status' => esc_sql($response->getStatus()),
                    'created' => date('Y-m-d H:i:s'),
                    'note' => ($response->getStatus() != 'success') ? esc_sql($response->getErrorMessage()) : ''
                )));

                if ($order->post_status != 'wc-pending' || $order->post_status == 'wc-processing') {
                    throw new \Exception('Invalid request');
                }


                $checkout_orderurl = $order->get_checkout_order_received_url();
                $transauthorised = false;

                if ($order->status !== 'completed') {
                    if ('success' == $response->getStatus()) {
                        $transauthorised = true;
                        $this->msg['message'] = __("Thank you for shopping with us. Your account has been charged and your transaction is successful.", 'iyzico-woocommerce-checkout-form');
                        $this->msg['class'] = 'woocommerce-message';

                        $installment = $response->getInstallment();
                        if (!empty($installment) && $installment > 1) {

                            $installment_fee    = $response->getPaidPrice() - $response->getPrice();    
                            $order_fee          = new stdClass();
                            $order_fee->id      = 'Installment Fee';
                            $order_fee->name    = __('Installment Fee', 'iyzico-woocommerce-checkout-form');
                            $order_fee->amount  = $installment_fee;
                            $order_fee->taxable = false;
                            $fee_id = $order->add_fee($order_fee);
                            $order->calculate_totals(true);

                         

                            update_post_meta($order_id, 'iyzi_no_of_installment', esc_sql($response->getInstallment()));
                            update_post_meta($order_id, 'iyzi_installment_fee', $installment_fee);
                        }

                        $order->payment_complete();
                        $order->add_order_note(__('Payment successful.', 'iyzico-woocommerce-checkout-form') . '<br/>' . __('Payment ID', 'iyzico-woocommerce-checkout-form') . ': ' . esc_sql($response->getPaymentId()));
                        $woocommerce->cart->empty_cart();
                    } else {
                        $this->msg['class'] = 'woocommerce-error';
                        $this->msg['message'] = __("Thank you for shopping with us. However, the transaction has been declined.", 'iyzico-woocommerce-checkout-form');
                        $order->add_order_note(__('Transaction ERROR', 'iyzico-woocommerce-checkout-form') . ': ' . $this->getValidErrorMessage($response, $siteLanguage));
                    }
                } else {
                    $this->msg['class'] = 'error';
                    $this->msg['message'] = __('Security error. Illegal access detected.', 'iyzico-woocommerce-checkout-form');
                }
                if ($transauthorised == false) {
                    $order->update_status('failed');
                }
                $customer_id = esc_sql($order->customer_user);
                if (!empty($customer_id)) {
                    
                    $card_user_key      = esc_sql($response->GetcardUserKey());
                    $merchant_api_id    = $this->api_id;
                    $table_name         = $wpdb->prefix . 'iyzico_checkout_form_user';
                    $iyzico_card_key    = $wpdb->get_row("SELECT card_key, iyzico_api, customer_id FROM $table_name WHERE customer_id= '$customer_id'");

                    if (empty($iyzico_card_key->customer_id)) {
                        $wpdb->insert(
                                $table_name, array(
                            'customer_id'   => $customer_id,
                            'card_key'      => $card_user_key,
                            'iyzico_api'    => $merchant_api_id,
                                )
                        );

                    } else {
                        
                        $card_user_key      = esc_sql($response->GetcardUserKey());
                        $merchant_api_id    = $this->api_id;
                        $table_name         = $wpdb->prefix . 'iyzico_checkout_form_user';

                        $wpdb->update(
                            $table_name, array(
                            'customer_id'   => $customer_id,
                            'card_key'      => $card_user_key,
                            'iyzico_api'    => $merchant_api_id,
                            ),
                            array('customer_id' => $customer_id)
                        );
                    }
                }

                $item_transactions = $response->getPaymentItems();

                foreach ($item_transactions as $item_transaction) {
                    $table_name = $wpdb->prefix . 'iyzico_order_refunds';

                    $wpdb->insert(
                        $table_name, array(
                        'order_id'                  => esc_sql($response->getBasketId()),
                        'paid_price'                => esc_sql($item_transaction->getPaidPrice()),
                        'item_id'                   => esc_sql($item_transaction->getItemId()),
                        'payment_transaction_id'    => esc_sql($item_transaction->getPaymentTransactionId()),
                        'total_refunded'            => 0
                        )
                    );
                }

                $redirect_url = add_query_arg(array('msg' => addslashes($this->msg['message']), 'type' => $this->msg['class']), $checkout_orderurl);
                wp_redirect($redirect_url);
                exit;
            } catch (\Exception $ex) {
                $respMsg = $ex->getMessage();
                $respMsg = !empty($respMsg) ? $respMsg : "Invalid Request";
                wc_add_notice(__($respMsg, 'iyzico-woocommerce-checkout-form'), 'error');
                $redirect_url = $woocommerce->cart->get_checkout_url();
                wp_redirect($redirect_url);
                exit;
            }
        }

    }

}

add_filter('woocommerce_payment_gateways', 'woocommerce_add_iyzico_checkout_form_gateway');

function woocommerce_add_iyzico_checkout_form_gateway($methods) {
    $methods[] = 'WC_Gateway_Iyzicocheckoutform';
    return $methods;
}

function iyzico_checkout_form_load_plugin_textdomain() {
    load_plugin_textdomain('iyzico-woocommerce-checkout-form', FALSE, plugin_basename(dirname(__FILE__)) . '/i18n/languages/');
}

add_action('plugins_loaded', 'iyzico_checkout_form_load_plugin_textdomain');

class iyzicocheckoutformGateway {

    private $_pluginSettings = array();
    private $_wcOrder = array();

    function __construct($settings, $order_id) {
        $this->_pluginSettings = $settings;
        $this->_wcOrder = new WC_Order($order_id);
    }

    function generatePaymentToken() {
        global $wpdb;
     

        require_once 'IyzipayBootstrap.php';

        IyzipayBootstrap::init();

        $api_id = $this->_pluginSettings['live_form_api_id'];
        $secret_key = $this->_pluginSettings['live_form_secret_key'];

        $cart_total = 0;
	$iyzico_version ="1.0.6";
        $options = new \Iyzipay\Options();
        $options->setApiKey($api_id);
        $options->setSecretKey($secret_key);
        $options->setBaseUrl(API_URL_FORM);

        $order_amount = $this->_wcOrder->order_total;
        $checkout_orderurl = $this->_wcOrder->get_checkout_order_received_url();
        $return_url = add_query_arg('wc-api', 'WC_Gateway_Iyzicocheckoutform', $checkout_orderurl);
        
        $request = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest();

        $siteLang = explode('_', get_locale());
        $locale = ($siteLang[0] == "tr") ? Iyzipay\Model\Locale::TR : Iyzipay\Model\Locale::EN;
        $request->setLocale($locale);
        $request->setConversationId(uniqid() . '_' . $this->_wcOrder->id);
        $request->setPaidPrice(round($order_amount, 2));
        $request->setBasketId($this->_wcOrder->id);
        $request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
        $request->setPaymentSource("WOOCOMMERCE-" . WOOCOMMERCE_VERSION .'-'. $iyzico_version);
        $request->setCallbackUrl($return_url);
	$request->setPaymentSource("WOOCOMMERCE-".$iyzico_version);
        $request->setCurrency($this->_wcOrder->get_order_currency());

        $first_name = !empty($this->_wcOrder->billing_first_name) ? $this->_wcOrder->billing_first_name : 'NOT PROVIDED';
        $last_name = !empty($this->_wcOrder->billing_last_name) ? $this->_wcOrder->billing_last_name : 'NOT PROVIDED';
        $phone = !empty($this->_wcOrder->billing_phone) ? $this->_wcOrder->billing_phone : 'NOT PROVIDED';
        $email = !empty($this->_wcOrder->billing_email) ? $this->_wcOrder->billing_email : 'NOT PROVIDED';
        $order_date = !empty($this->_wcOrder->order_date) ? $this->_wcOrder->order_date : 'NOT PROVIDED';
        $modified_date = !empty($this->_wcOrder->modified_date) ? $this->_wcOrder->modified_date : 'NOT PROVIDED';
        $city_buyer = WC()->countries->states[$this->_wcOrder->billing_country][$this->_wcOrder->billing_state];
        $city = !empty($city_buyer) ? $city_buyer : 'NOT PROVIDED';
        $country = !empty(WC()->countries->countries[$this->_wcOrder->billing_country]) ? WC()->countries->countries[$this->_wcOrder->billing_country] : 'NOT PROVIDED';
        $postcode = !empty($this->_wcOrder->billing_postcode) ? $this->_wcOrder->billing_postcode : 'NOT PROVIDED';

        $shipping_city = !empty($this->_wcOrder->shipping_city) ? $this->_wcOrder->shipping_city : 'NOT PROVIDED';
        $shipping_country = !empty(WC()->countries->countries[$this->_wcOrder->shipping_country]) ? WC()->countries->countries[$this->_wcOrder->shipping_country] : 'NOT PROVIDED';
        $shipping_postcode = !empty($this->_wcOrder->shipping_postcode) ? $this->_wcOrder->shipping_postcode : 'NOT PROVIDED';

        $customer_billing_address = trim($this->_wcOrder->billing_address_1) . " " . trim($this->_wcOrder->billing_address_2);
        $customer_billing_address = !empty($customer_billing_address) ? $customer_billing_address : "NOT PROVIDED";
        $customer_id = esc_sql($this->_wcOrder->customer_user);
        if (!empty($customer_id)) {
            $table_name = $wpdb->prefix . 'iyzico_checkout_form_user';
            $iyzico_card_key = $wpdb->get_row("SELECT card_key, iyzico_api, customer_id FROM $table_name WHERE customer_id='$customer_id'");


            if ($iyzico_card_key->iyzico_api == $api_id) {

                $request->setCardUserKey($iyzico_card_key->card_key);
            }
        }

        $buyer = new \Iyzipay\Model\Buyer();
        $buyer->setId($this->_wcOrder->id);
        $buyer->setName($first_name);
        $buyer->setSurname($last_name);
        $buyer->setGsmNumber($phone);
        $buyer->setEmail($email);
        $buyer->setLastLoginDate($order_date);
        $buyer->setRegistrationDate($modified_date);
        $buyer->setRegistrationAddress($customer_billing_address);
        $buyer->setCity($city);
        $buyer->setCountry($country);
        $buyer->setZipCode($postcode);
        $buyer->setIp($_SERVER['REMOTE_ADDR']);

        $customer_identity_number = str_pad(uniqid(), 11, '0', STR_PAD_LEFT);
        $buyer->setIdentityNumber($customer_identity_number);
        $request->setBuyer($buyer);

        $billing_full_name = $this->_wcOrder->get_formatted_billing_full_name();
        $billing_full_name = !empty($billing_full_name) ? $billing_full_name : "NOT PROVIDED";
        $billing_address = new \Iyzipay\Model\Address();
        $billing_address->setContactName($billing_full_name);
        $billing_address->setCity($city);
        $billing_address->setCountry($country);
        $billing_address->setAddress($customer_billing_address);
        $billing_address->setZipCode($postcode);
        $request->setBillingAddress($billing_address);

        $shipping_full_name = $this->_wcOrder->get_formatted_shipping_full_name();
        $shipping_full_name = empty($shipping_full_name) ? $shipping_full_name : "NOT PROVIDED";
     	if(empty($this->_wcOrder->shipping_address_1)){
						$customer_shipping_address=$customer_billing_address;
		}else{
			   $customer_shipping_address = trim($this->_wcOrder->shipping_address_1) . " " . trim($this->_wcOrder->shipping_address_2);
		}
        $shipping_address = new \Iyzipay\Model\Address();
        $shipping_address->setContactName($shipping_full_name);
        $shipping_address->setCity($shipping_city);
        $shipping_address->setCountry($shipping_country);
        $shipping_address->setAddress($customer_shipping_address);
        $shipping_address->setZipCode($shipping_postcode);
        $request->setShippingAddress($shipping_address);

        $items = array();
        $sub_total = 0;
        $product_final_price = 0;
        global $woocommerce;
        $items_array = $woocommerce->cart->get_cart();
        $shipping_total = $this->_wcOrder->get_total_shipping() + $this->_wcOrder->get_shipping_tax();

        foreach ($items_array as $item) {
            $sub_total = WC()->cart->subtotal_ex_tax;
            $product_cats = wp_get_post_terms($item['product_id'], 'product_cat');

            $product = new WC_Product($item['product_id']);

            if ($product->is_downloadable() || $product->is_virtual()) {
                $request_type = \Iyzipay\Model\BasketItemType::VIRTUAL;
            } else {
                $request_type = \Iyzipay\Model\BasketItemType::PHYSICAL;
            }

            if ($product_cats && !is_wp_error($product_cats)) {
                $single_cat = array_shift($product_cats);
            }
            $product_final_price = $item['line_total'] + $item['line_tax'];

            if ($shipping_total > 0) {
                $product_with_shipping = (($item['data']->price * $item['quantity']) / $sub_total) * $shipping_total;
                $product_final_price += $product_with_shipping;
            }

            $category = !empty($single_cat->name) ? $single_cat->name : 'NOT PROVIDED';

            $product_detail = new \Iyzipay\Model\BasketItem();
            $product_detail->setId($item['product_id']);
            $product_detail->setName($item['data']->post->post_title);
            $product_detail->setCategory1($category);
            $product_detail->setItemType($request_type);
            $product_detail->setPrice(round($product_final_price, 2));
            $cart_total += round($product_final_price, 2);

            if ($product_detail->getPrice() > 0) {
                $items[] = $product_detail;
            }
        }

        if ($order_amount != $cart_total) {
            $amount_difference = $order_amount - $cart_total;
            $item_array_keys = array_keys($items);
            $last_item = end($item_array_keys);
            $last_item_amount = $items[$last_item]->getPrice() + $amount_difference;
            $cart_total += $amount_difference;
            $new_price = round($last_item_amount, 2);
            $items[$last_item]->setPrice($new_price);
            if ($new_price <= 0) {
                unset($items[$last_item]);
            }
        }

        $request->setPrice($cart_total);
        $request->setBasketItems($items);

        if (empty($items)) {
            wp_redirect($this->_wcOrder->get_checkout_order_received_url());
        } else {
            $response = \Iyzipay\Model\CheckoutFormInitialize::create($request, $options);

            update_post_meta($this->_wcOrder->id, 'payment_form_initialization', json_encode(array(
                'api_request'           => $request->toJsonString(),
                'api_response'          => esc_sql($response->getRawResult()),
                'processing_timestamp'  => date('Y-m-d H:i:s', $response->getSystemTime() / 1000),
                'transaction_status'    => esc_sql($response->getStatus()),
                'created'               => date('Y-m-d H:i:s'),
                'note'                  => ($response->getStatus() != 'success') ? $response->getErrorMessage() : ''
            )));

            return $response;
        }
    }


}
