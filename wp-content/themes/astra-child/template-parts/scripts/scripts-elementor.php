<?php

/**
 * The scripts after footer for elementor shortcode contents
 *
 * This is the template that displays header shortcode contents for elementor
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */
?>


<script type="text/x-template" id="mobile-menu-item-template"><li
	:id="'jet-menu-item-'+itemDataObject.itemId"
	:class="itemClasses"
>
	<div
		class="jet-mobile-menu__item-inner"
		tabindex="1"
		:aria-label="itemDataObject.name"
		v-on:click="itemSubHandler"
		v-on:keyup.enter="itemSubHandler"
	>
		<a
			:class="itemLinkClasses"
			:href="itemDataObject.url"
			:rel="itemDataObject.xfn"
			:title="itemDataObject.attrTitle"
			:target="itemDataObject.target"
		>
			<div class="jet-menu-item-wrapper">
				<div
					class="jet-menu-icon"
					v-if="isIconVisible"
					v-html="itemIconHtml"
				></div>
				<div class="jet-menu-name">
					<span
						class="jet-menu-label"
						v-html="itemDataObject.name"
					></span>
					<small
						class="jet-menu-desc"
						v-if="isDescVisible"
						v-html="itemDataObject.description"
					></small>
				</div>
				<small
					class="jet-menu-badge"
					v-if="isBadgeVisible"
				>
					<span class="jet-menu-badge__inner">{{ itemDataObject.badgeText }}</span>
				</small>
			</div>
		</a>
		<span
			class="jet-dropdown-arrow"
			v-if="isSub && !templateLoadStatus"
			v-html="dropdownIconHtml"
			v-on:click="markerSubHandler"
		>
		</span>
		<div
			class="jet-mobile-menu__template-loader"
			v-if="templateLoadStatus"
		>
			<svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="24px" height="25px" viewBox="0 0 128 128" xml:space="preserve">
				<g>
					<linearGradient id="linear-gradient">
						<stop offset="0%" :stop-color="loaderColor" stop-opacity="0"/>
						<stop offset="100%" :stop-color="loaderColor" stop-opacity="1"/>
					</linearGradient>
				<path d="M63.85 0A63.85 63.85 0 1 1 0 63.85 63.85 63.85 0 0 1 63.85 0zm.65 19.5a44 44 0 1 1-44 44 44 44 0 0 1 44-44z" fill="url(#linear-gradient)" fill-rule="evenodd"/>
				<animateTransform attributeName="transform" type="rotate" from="0 64 64" to="360 64 64" dur="1080ms" repeatCount="indefinite"></animateTransform>
				</g>
			</svg>
		</div>
	</div>

	<transition name="menu-container-expand-animation">
		<mobile-menu-list
			v-if="isDropdownLayout && subDropdownVisible"
			:depth="depth+1"
			:children-object="itemDataObject.children"
		></mobile-menu-list>
	</transition>

</li>
					</script>
<script type="text/x-template" id="mobile-menu-list-template"><div
	class="jet-mobile-menu__list"
	role="navigation"
>
	<ul class="jet-mobile-menu__items">
		<mobile-menu-item
			v-for="(item, index) in childrenObject"
			:key="item.id"
			:item-data-object="item"
			:depth="depth"
		></mobile-menu-item>
	</ul>
</div>
</script>

<script type="text/x-template" id="mobile-menu-template">
	<div
	:class="instanceClass"
	v-on:keyup.esc="escapeKeyHandler"
	>
	<div
		class="jet-mobile-menu__toggle"
		ref="toggle"
		tabindex="1"
		aria-label="Open/Close Menu"
		v-on:click="menuToggle"
		v-on:keyup.enter="menuToggle"
	>
		<div
			class="jet-mobile-menu__template-loader"
			v-if="toggleLoaderVisible"
		>
			<svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="24px" height="25px" viewBox="0 0 128 128" xml:space="preserve">
				<g>
					<linearGradient id="linear-gradient">
						<stop offset="0%" :stop-color="loaderColor" stop-opacity="0"/>
						<stop offset="100%" :stop-color="loaderColor" stop-opacity="1"/>
					</linearGradient>
				<path d="M63.85 0A63.85 63.85 0 1 1 0 63.85 63.85 63.85 0 0 1 63.85 0zm.65 19.5a44 44 0 1 1-44 44 44 44 0 0 1 44-44z" fill="url(#linear-gradient)" fill-rule="evenodd"/>
				<animateTransform attributeName="transform" type="rotate" from="0 64 64" to="360 64 64" dur="1080ms" repeatCount="indefinite"></animateTransform>
				</g>
			</svg>
		</div>

		<div
			class="jet-mobile-menu__toggle-icon"
			v-if="!menuOpen && !toggleLoaderVisible"
			v-html="toggleClosedIcon"
		></div>
		<div
			class="jet-mobile-menu__toggle-icon"
			v-if="menuOpen && !toggleLoaderVisible"
			v-html="toggleOpenedIcon"
		></div>
		<span
			class="jet-mobile-menu__toggle-text"
			v-if="toggleText"
			v-html="toggleText"
		></span>

	</div>

	<transition name="cover-animation">
		<div
			class="jet-mobile-menu-cover"
			v-if="menuContainerVisible && coverVisible"
			v-on:click="closeMenu"
		></div>
	</transition>

	<transition :name="showAnimation">
		<div
			class="jet-mobile-menu__container"
			v-if="menuContainerVisible"
		>
			<div
				class="jet-mobile-menu__container-inner"
			>
				<div
					class="jet-mobile-menu__header-template"
					v-if="headerTemplateVisible"
				>
					<div
						class="jet-mobile-menu__header-template-content"
						ref="header-template-content"
						v-html="headerContent"
					></div>
				</div>

				<div
					class="jet-mobile-menu__controls"
				>
					<div
						class="jet-mobile-menu__breadcrumbs"
						v-if="isBreadcrumbs"
					>
						<div
							class="jet-mobile-menu__breadcrumb"
							v-for="(item, index) in breadcrumbsPathData"
							:key="index"
						>
							<div
								class="breadcrumb-label"
								v-on:click="breadcrumbHandle(index+1)"
								v-html="item"
							></div>
							<div
								class="breadcrumb-divider"
								v-html="breadcrumbIcon"
								v-if="(breadcrumbIcon && index !== breadcrumbsPathData.length-1)"
							></div>
						</div>
					</div>
					<div
						class="jet-mobile-menu__back"
						ref="back"
						tabindex="1"
						aria-label="Close Menu"
						v-if="!isBack && isClose"
						v-html="closeIcon"
						v-on:click="menuToggle"
						v-on:keyup.enter="menuToggle"
					></div>
					<div
						class="jet-mobile-menu__back"
						ref="back"
						tabindex="1"
						aria-label="Back to Prev Items"
						v-if="isBack"
						v-html="backIcon"
						v-on:click="goBack"
						v-on:keyup.enter="goBack"
					></div>
				</div>

				<div
					class="jet-mobile-menu__before-template"
					v-if="beforeTemplateVisible"
				>
					<div
						class="jet-mobile-menu__before-template-content"
						ref="before-template-content"
						v-html="beforeContent"
					></div>
				</div>

				<div
					class="jet-mobile-menu__body"
				>
					<transition :name="animation">
						<mobile-menu-list
							v-if="!templateVisible"
							:key="depth"
							:depth="depth"
							:children-object="itemsList"
						></mobile-menu-list>
						<div
							class="jet-mobile-menu__template"
							ref="template-content"
							v-if="templateVisible"
						>
							<div
								class="jet-mobile-menu__template-content"
								v-html="itemTemplateContent"
							></div>
						</div>
					</transition>
				</div>

				<div
					class="jet-mobile-menu__after-template"
					v-if="afterTemplateVisible"
				>
					<div
						class="jet-mobile-menu__after-template-content"
						ref="after-template-content"
						v-html="afterContent"
					></div>
				</div>

			</div>
		</div>
	</transition>
</div>
					</script>
<script type="text/javascript">
	(function() {
		var c = document.body.className;
		c = c.replace(/woocommerce-no-js/, 'woocommerce-js');
		document.body.className = c;
	})();
</script>

<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/jet-menu/integration/themes/astra/assets/js/script6b25.js?ver=2.1.4" id="jet-menu-astra-js"></script>
<script id="astra-theme-js-js-extra">
	var astra = {
		"break_point": "921",
		"isRtl": "",
		"edit_post_url": "https:\/\/<?php echo site_url(); ?>\/<?php echo site_url(); ?>/wp-admin\/post.php?post={{id}}&action=edit",
		"ajax_url": "https:\/\/<?php echo site_url(); ?>\/<?php echo site_url(); ?>/wp-admin\/admin-ajax.php",
		"shop_infinite_count": "2",
		"shop_infinite_total": "0",
		"shop_pagination": "number",
		"shop_infinite_scroll_event": "scroll",
		"shop_no_more_post_message": "No more products to show.",
		"checkout_prev_text": "Back to my details",
		"checkout_next_text": "Proceed to payment",
		"show_comments": "Show Comments",
		"shop_quick_view_enable": "disabled",
		"shop_quick_view_stick_cart": "",
		"shop_quick_view_auto_height": "1",
		"single_product_ajax_add_to_cart": "",
		"is_cart": "",
		"is_single_product": "",
		"view_cart": "View cart",
		"cart_url": "https:\/\/<?php echo site_url(); ?>\/basket\/"
	};
</script>
<script src="<?php echo site_url(); ?>/wp-content/themes/astra-child/assets/js/minified/frontend.min9a99.js?ver=3.7.10" id="astra-theme-js-js"></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/woocommerce/assets/js/jquery-blockui/jquery.blockUI.mine230.js?ver=2.7.0-wc.6.4.1" id="jquery-blockui-js"></script>
<script id="wc-add-to-cart-js-extra">
	var wc_add_to_cart_params = {
		"ajax_url": "\/<?php echo site_url(); ?>/wp-admin\/admin-ajax.php",
		"wc_ajax_url": "\/?wc-ajax=%%endpoint%%&elementor_page_id=477",
		"i18n_view_cart": "View basket",
		"cart_url": "https:\/\/<?php echo site_url(); ?>\/basket\/",
		"is_cart": "",
		"cart_redirect_after_add": "no"
	};
</script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/woocommerce/assets/js/frontend/add-to-cart.minaec2.js?ver=6.4.1" id="wc-add-to-cart-js"></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/woocommerce/assets/js/js-cookie/js.cookie.minc4da.js?ver=2.1.4-wc.6.4.1" id="js-cookie-js"></script>
<script id="woocommerce-js-extra">
	var woocommerce_params = {
		"ajax_url": "\/<?php echo site_url(); ?>/wp-admin\/admin-ajax.php",
		"wc_ajax_url": "\/?wc-ajax=%%endpoint%%&elementor_page_id=477"
	};
</script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/woocommerce/assets/js/frontend/woocommerce.minaec2.js?ver=6.4.1" id="woocommerce-js"></script>
<script id="wc-cart-fragments-js-extra">
	var wc_cart_fragments_params = {
		"ajax_url": "\/<?php echo site_url(); ?>/wp-admin\/admin-ajax.php",
		"wc_ajax_url": "\/?wc-ajax=%%endpoint%%&elementor_page_id=477",
		"cart_hash_key": "wc_cart_hash_974494e87742e4a4086058bf25a5b2b4",
		"fragment_name": "wc_fragments_974494e87742e4a4086058bf25a5b2b4",
		"request_timeout": "5000"
	};
</script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/woocommerce/assets/js/frontend/cart-fragments.minaec2.js?ver=6.4.1" id="wc-cart-fragments-js"></script>

<script src='<?php echo site_url(); ?>/wp-includes-copy/js/imagesloaded.mineda1.js?ver=4.1.4' id='imagesloaded-js'></script>
<script id="astra-addon-js-js-extra">
	var astraAddon = {
		"sticky_active": "",
		"svgIconClose": "<span class=\"ast-icon icon-close\"><svg viewBox=\"0 0 512 512\" aria-hidden=\"true\" role=\"img\" version=\"1.1\" xmlns=\"http:\/\/www.w3.org\/2000\/svg\" xmlns:xlink=\"http:\/\/www.w3.org\/1999\/xlink\" width=\"18px\" height=\"18px\">\n                                <path d=\"M71.029 71.029c9.373-9.372 24.569-9.372 33.942 0L256 222.059l151.029-151.03c9.373-9.372 24.569-9.372 33.942 0 9.372 9.373 9.372 24.569 0 33.942L289.941 256l151.03 151.029c9.372 9.373 9.372 24.569 0 33.942-9.373 9.372-24.569 9.372-33.942 0L256 289.941l-151.029 151.03c-9.373 9.372-24.569 9.372-33.942 0-9.372-9.373-9.372-24.569 0-33.942L222.059 256 71.029 104.971c-9.372-9.373-9.372-24.569 0-33.942z\" \/>\n                            <\/svg><\/span>",
		"product_plus_minus_text": {
			"plus_qty": "Plus Quantity",
			"minus_qty": "Minus Quantity"
		},
		"is_header_builder_active": "1"
	};
</script>
<script src="<?php echo site_url(); ?>/wp-content/uploads/astra-addon/astra-addon-6283a493d12c66-41684699a4f3.js?ver=3.6.8" id="astra-addon-js-js"></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/astra-addon/addons/woocommerce/assets/js/minified/single-product-ajax-cart.mina4f3.js?ver=3.6.8" id="astra-single-product-ajax-cart-js"></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/jet-menu/assets/public/lib/vue/vue.mina117.js?ver=2.6.11" id="jet-vue-js"></script>
<script id="jet-menu-public-scripts-js-extra">
	var jetMenuPublicSettings = {
		"version": "2.1.4",
		"ajaxUrl": "https:\/\/<?php echo site_url(); ?>\/<?php echo site_url(); ?>/wp-admin\/admin-ajax.php",
		"isMobile": "false",
		"templateApiUrl": "https:\/\/<?php echo site_url(); ?>\/wp-json\/jet-menu-api\/v1\/elementor-template",
		"menuItemsApiUrl": "https:\/\/<?php echo site_url(); ?>\/wp-json\/jet-menu-api\/v1\/get-menu-items",
		"restNonce": "4f2e784cf2",
		"devMode": "false",
		"wpmlLanguageCode": "",
		"menuSettings": {
			"jetMenuRollUp": "true",
			"jetMenuMouseleaveDelay": 500,
			"jetMenuMegaWidthType": "container",
			"jetMenuMegaWidthSelector": "",
			"jetMenuMegaOpenSubType": "hover",
			"jetMenuMegaAjax": "false"
		}
	};
	var CxCollectedCSS = {
		"type": "text\/css",
		"title": "cx-collected-dynamic-style",
		"css": ".jet-menu .jet-menu-item-368 > a {padding-top:5px !important; padding-right:15px !important; padding-bottom:5px !important; padding-left:15px !important; }.jet-menu .jet-menu-item-368 > .jet-mobile-menu__item-inner > a {padding-top:5px !important; padding-right:15px !important; padding-bottom:5px !important; padding-left:15px !important; }.jet-mobile-menu-single .jet-menu-icon {-webkit-align-self:center; align-self:center; }.jet-mobile-menu-single .jet-menu-badge {-webkit-align-self:center; align-self:center; }"
	};
</script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/jet-menu/assets/public/js/legacy/jet-menu-public-scripts6b25.js?ver=2.1.4" id="jet-menu-public-scripts-js"></script>
<script id="jet-menu-public-scripts-js-after">
	function CxCSSCollector() {
		"use strict";
		var t, e = window.CxCollectedCSS;
		void 0 !== e && ((t = document.createElement("style")).setAttribute("title", e.title), t.setAttribute("type", e.type), t.textContent = e.css, document.head.appendChild(t))
	}
	CxCSSCollector();
</script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/wc-quantity-plus-minus-button/assets/js/scripts8a54.js?ver=1.0.0" id="wqpmb-script-js"></script>
<script id="wapf-frontend-js-extra">
	var wapf_config = {
		"ajax": "https:\/\/<?php echo site_url(); ?>\/<?php echo site_url(); ?>/wp-admin\/admin-ajax.php",
		"page_type": "other",
		"display_options": {
			"format": "%1$s%2$s",
			"symbol": "&pound;",
			"decimals": 2,
			"decimal": ".",
			"thousand": ","
		},
		"slider_support": "1"
	};
</script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/advanced-product-fields-for-woocommerce-pro/assets/js/frontend.min609c.js?ver=1.9.8" id="wapf-frontend-js"></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/powerpack-elements/assets/js/min/frontend-mini-cart.mind537.js?ver=2.7.6" id="pp-mini-cart-js"></script>
<script id="pp-woocommerce-js-extra">
	var pp_woo_products_script = {
		"ajax_url": "https:\/\/<?php echo site_url(); ?>\/wp-admin\/admin-ajax.php",
		"get_product_nonce": "dacb985fc7",
		"quick_view_nonce": "098bcc9183",
		"add_cart_nonce": "b700055f28",
		"is_cart": "",
		"is_single_product": "",
		"view_cart": "View cart",
		"cart_url": "https:\/\/<?php echo site_url(); ?>\/basket\/"
	};
</script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/powerpack-elements/assets/js/min/pp-woocommerce.mind537.js?ver=2.7.6" id="pp-woocommerce-js"></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/powerpack-elements/assets/lib/smartmenu/jquery-smartmenuc64e.js?ver=1.1.1" id="jquery-smartmenu-js"></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/powerpack-elements/assets/js/min/frontend-advanced-menu.mind537.js?ver=2.7.6" id="pp-advanced-menu-js"></script>
<script id="powerpack-frontend-js-extra">
	var ppLogin = {
		"empty_username": "Enter a username or email address.",
		"empty_password": "Enter password.",
		"empty_password_1": "Enter a password.",
		"empty_password_2": "Re-enter password.",
		"empty_recaptcha": "Please check the captcha to verify you are not a robot.",
		"email_sent": "A password reset email has been sent to the email address for your account, but may take several minutes to show up in your inbox. Please wait at least 10 minutes before attempting another reset.",
		"reset_success": "Your password has been reset successfully.",
		"ajax_url": "https:\/\/<?php echo site_url(); ?>\/<?php echo site_url(); ?>/wp-admin\/admin-ajax.php"
	};
	var ppRegistration = {
		"invalid_username": "This username is invalid because it uses illegal characters. Please enter a valid username.",
		"username_exists": "This username is already registered. Please choose another one.",
		"empty_email": "Please type your email address.",
		"invalid_email": "The email address isn\u2019t correct!",
		"email_exists": "The email is already registered, please choose another one.",
		"password": "Password must not contain the character \"\\\\\"",
		"password_length": "Your password should be at least 8 characters long.",
		"password_mismatch": "Password does not match.",
		"invalid_url": "URL seems to be invalid.",
		"recaptcha_php_ver": "reCAPTCHA API requires PHP version 5.3 or above.",
		"recaptcha_missing_key": "Your reCAPTCHA Site or Secret Key is missing!",
		"show_password": "Show password",
		"hide_password": "Hide password",
		"ajax_url": "https:\/\/<?php echo site_url(); ?>\/<?php echo site_url(); ?>/wp-admin\/admin-ajax.php"
	};
</script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/powerpack-elements/assets/js/min/frontend.mind537.js?ver=2.7.6" id="powerpack-frontend-js"></script>
<script id="jet-engine-frontend-js-extra">
	var JetEngineSettings = {
		"ajaxurl": "https:\/\/<?php echo site_url(); ?>\/<?php echo site_url(); ?>/wp-admin\/admin-ajax.php",
		"ajaxlisting": "https:\/\<?php echo site_url(); ?>\/?nocache=1652803490",
		"mapPopupTimeout": "400",
		"addedPostCSS": ["3870"]
	};
</script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/jet-engine/assets/js/frontend8fbb.js?ver=2.11.7" id="jet-engine-frontend-js"></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/elementor-pro/assets/js/webpack-pro.runtime.min3088.js?ver=3.7.0" id="elementor-pro-webpack-runtime-js"></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/elementor/assets/js/webpack.runtime.min3ab2.js?ver=3.6.5" id="elementor-webpack-runtime-js"></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/elementor/assets/js/frontend-modules.min3ab2.js?ver=3.6.5" id="elementor-frontend-modules-js"></script>
<script src='<?php echo site_url(); ?>/wp-includes-copy/js/dist/vendor/regenerator-runtime.min3937.js?ver=0.13.9' id='regenerator-runtime-js'></script>
<script src='<?php echo site_url(); ?>/wp-includes-copy/js/dist/vendor/wp-polyfill.min2c7c.js?ver=3.15.0' id='wp-polyfill-js'></script>
<script src='<?php echo site_url(); ?>/wp-includes-copy/js/dist/hooks.min8cbb.js?ver=1e58c8c5a32b2e97491080c5b10dc71c' id='wp-hooks-js'></script>
<script src='<?php echo site_url(); ?>/wp-includes-copy/js/dist/i18n.mina28b.js?ver=30fcecb428a0e8383d3776bcdd3a7834' id='wp-i18n-js'></script>
<script id='wp-i18n-js-after'>
	wp.i18n.setLocaleData({
		'text direction\u0004ltr': ['ltr']
	});
</script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/elementor-pro/assets/js/frontend.min3088.js?ver=3.7.0" id="elementor-pro-frontend-js"></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/elementor/assets/lib/waypoints/waypoints.min05da.js?ver=4.0.2" id="elementor-waypoints-js"></script>
<script src='<?php echo site_url(); ?>/wp-includes-copy/js/jquery/ui/core.min0028.js?ver=1.13.1' id='jquery-ui-core-js'></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/elementor/assets/lib/swiper/swiper.min48f5.js?ver=5.3.6" id="swiper-js"></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/elementor/assets/lib/share-link/share-link.min3ab2.js?ver=3.6.5" id="share-link-js"></script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/elementor/assets/lib/dialog/dialog.mind227.js?ver=4.9.0" id="elementor-dialog-js"></script>
<script id="elementor-frontend-js-before">
	var elementorFrontendConfig = {
		"environmentMode": {
			"edit": false,
			"wpPreview": false,
			"isScriptDebug": false
		},
		"i18n": {
			"shareOnFacebook": "Share on Facebook",
			"shareOnTwitter": "Share on Twitter",
			"pinIt": "Pin it",
			"download": "Download",
			"downloadImage": "Download image",
			"fullscreen": "Fullscreen",
			"zoom": "Zoom",
			"share": "Share",
			"playVideo": "Play Video",
			"previous": "Previous",
			"next": "Next",
			"close": "Close"
		},
		"is_rtl": false,
		"breakpoints": {
			"xs": 0,
			"sm": 480,
			"md": 768,
			"lg": 1025,
			"xl": 1440,
			"xxl": 1600
		},
		"responsive": {
			"breakpoints": {
				"mobile": {
					"label": "Mobile",
					"value": 767,
					"default_value": 767,
					"direction": "max",
					"is_enabled": true
				},
				"mobile_extra": {
					"label": "Mobile Extra",
					"value": 880,
					"default_value": 880,
					"direction": "max",
					"is_enabled": false
				},
				"tablet": {
					"label": "Tablet",
					"value": 1024,
					"default_value": 1024,
					"direction": "max",
					"is_enabled": true
				},
				"tablet_extra": {
					"label": "Tablet Extra",
					"value": 1200,
					"default_value": 1200,
					"direction": "max",
					"is_enabled": false
				},
				"laptop": {
					"label": "Laptop",
					"value": 1366,
					"default_value": 1366,
					"direction": "max",
					"is_enabled": false
				},
				"widescreen": {
					"label": "Widescreen",
					"value": 2400,
					"default_value": 2400,
					"direction": "min",
					"is_enabled": false
				}
			}
		},
		"version": "3.6.5",
		"is_static": false,
		"experimentalFeatures": {
			"e_dom_optimization": true,
			"e_optimized_css_loading": true,
			"a11y_improvements": true,
			"e_import_export": true,
			"additional_custom_breakpoints": true,
			"e_hidden_wordpress_widgets": true,
			"theme_builder_v2": true,
			"landing-pages": true,
			"elements-color-picker": true,
			"favorite-widgets": true,
			"admin-top-bar": true,
			"page-transitions": true,
			"notes": true,
			"form-submissions": true,
			"e_scroll_snap": true
		},
		"urls": {
			"assets": "https:\/\/<?php echo site_url(); ?>\/<?php echo site_url(); ?>/wp-content\/plugins\/elementor\/assets\/"
		},
		"settings": {
			"page": [],
			"editorPreferences": []
		},
		"kit": {
			"body_background_background": "classic",
			"active_breakpoints": ["viewport_mobile", "viewport_tablet"],
			"global_image_lightbox": "yes",
			"lightbox_enable_counter": "yes",
			"lightbox_enable_fullscreen": "yes",
			"lightbox_enable_zoom": "yes",
			"lightbox_enable_share": "yes",
			"lightbox_title_src": "title",
			"lightbox_description_src": "description",
			"woocommerce_notices_elements": []
		},
		"post": {
			"id": 477,
			"title": "Motiq%20%E2%80%93%20Custom%20Premium%20Sports%20Apparel",
			"excerpt": "",
			"featuredImage": "https:\/\/<?php echo site_url(); ?>\/<?php echo site_url(); ?>/wp-content\/uploads\/2022\/05\/Haze_10x30_Panoramic-copy-1024x401.webp"
		}
	};
</script>
<script src="<?php echo site_url(); ?>/wp-content/plugins-copy/elementor/assets/js/frontend.min3ab2.js?ver=3.6.5" id="elementor-frontend-js"></script><span id="elementor-device-mode" class="elementor-screen-only"></span>