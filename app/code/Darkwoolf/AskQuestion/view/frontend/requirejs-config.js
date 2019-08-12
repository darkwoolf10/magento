var config = {
    'config': {
        'mixins': {
            'mega/validation': {
                'Darkwoolf_AskQuestion/js/phone-ukr-mixin': true
            },
            'Magento_Ui/js/lib/validation/rules': {
                'Darkwoolf_AskQuestion/js/rule-mobile-ukrainian-ui-mixin': true
            }
        }
    },
    map: {
        '*': {
            askquestion: 'Darkwoolf_AskQuestion/js/askquestion'
        }
    }
};