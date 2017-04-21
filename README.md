# Augustash_FixSalesRule

## Overview:

Fixes product condition validation logic, especially for configurable products. Implements the workaround proposed in [magento/magento2#8407](https://github.com/magento/magento2/issues/8407).


## Installation

In your project's `composer.json` file, add the following lines to the `require` and `repositories` sections:

```js
{
    "require": {
        "augustash/module-sales-rule-fix-product-condition": "dev-master"
    },
    "repositories": {
        "augustash-sales-rule-fix-product-condition": {
            "type": "vcs",
            "url": "https://github.com/augustash/magento2-module-sales-rule-fix-product-condition.git"
        }
    }
}
```
