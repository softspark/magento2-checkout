define([
    'Magento_Checkout/js/model/quote',
    'uiRegistry'
], function (
    quote, registry
) {
    'use strict';

    return function (target) {
        return target.extend({
            defaults: {
                externalOrderIdScope: 'checkout.steps.shipping-step.shippingAddress.before-form.external_order_id'
            },

            validateShippingInformation: function () {
                var result = this._super();

                if (!this.isValid()) {
                    return false;
                }

                this.setExternalOrderId(this.getExternalOrderId());

                return result;
            },

            setExternalOrderId: function (value) {

                var shippingAddress = quote.shippingAddress();

                if (shippingAddress['extensionAttributes'] === undefined) {
                    shippingAddress['extensionAttributes'] = {};
                }

                shippingAddress['extensionAttributes']['external_order_id'] = value;
            },

            getExternalOrderId: function () {
                return registry.get(this.externalOrderIdScope).value();
            },

            isValid: function () {
                return registry.get(this.externalOrderIdScope).validate().valid;
            }
        })
    }
});
