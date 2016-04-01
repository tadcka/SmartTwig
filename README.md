# SmartTwig

## Installation

Install via [Composer](https://getcomposer.org/)

```
composer require tadcka/smart-twig "dev-master"
```

## Templates Hinting

SmartTwig allows to enable templates hinting and in such a way helps to frontend developer to find proper template.
This option can be enabled in application configuration with redefining base template class for twig:

How use with Symfony?

```yaml
twig:
    base_template_class: Tadcka\SmartTwig\Template
```

As a result of such change user can find HTML comments on the page
```html
<!-- Start Template: template_name.html.twig -->
...
<!-- End Template: template_name.html.twig -->
```
or see "template_name" variable for AJAX requests that expecting JSON
```json
"template_name":"template_name.html.twig"
```

The templates hinting is enabled by default in development mode.