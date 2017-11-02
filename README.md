# WooCommerce Variation Structured Data - Option 6

Changes the structured data output by WooCommerce as part of investigations into [WooCommerce issue #17471](https://github.com/woocommerce/woocommerce/issues/17471).

If the query string contains the variation attributes to identify a specific variation of the product, then an additional Product item (with associated Offer) will be added to the schema for the selected variation *alongside* the default Product/AggregateOffer item.

**Note:  
This is not intended as a final solution, or a long-term production plugin. Use it only if you are assisting with the investigation into [WooCommerce issue #17471](https://github.com/woocommerce/woocommerce/issues/17471).**

### http://www.example.com/product/variable-widget
Standard WooCommerce behaviour. An single Product, with AggregateOffer showing Min/Max prices.

```jsonld
{
    "@type": "Product",
    "@id": "http:\/\/www.example.com\/product\/variable-widget\/",
    "name": "Variable widget",
    "image": "http:\/\/www.example.com\/wp-content\/uploads\/2017\/10\/widget-grey.jpg",
    "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit.",
    "sku": "VARIABLEWIDGETSKU",
    "offers": [
        {
            "@type": "AggregateOffer",
            "lowPrice": "21.99",
            "highPrice": "27.99",
            "priceCurrency": "GBP",
            "availability": "https:\/\/schema.org\/InStock",
            "url": "http:\/\/www.example.com\/product\/variable-widget\/",
            "seller": {
                "@type": "Organization",
                "name": "WC Devbox",
                "url": "http:\/\/www.example.com"
            }
        }
    ]
}
```

### http://www.example.com/my-variable-widget/?attribute_pa_color=red
Additional Product record (with Offer, not AggregateOffer) for the specific selected variation. 

Note: At this stage, the image / description / SKU still inherit the main product values. In a final / improved solution these should reflect the values of the specific variation.

```jsonld
{
    "@type": "Product",
    "@id": "http:\/\/www.example.com\/product\/variable-widget\/?attribute_pa_color=red",
    "name": "Variable widget",
    "image": "http:\/\/www.example.com\/wp-content\/uploads\/2017\/10\/widget-grey.jpg",
    "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit.",
    "sku": "VARIABLEWIDGETSKU",
    "offers": [
        {
            "@type": "Offer",
            "price": "23.99",
            "priceCurrency": "GBP",
            "availability": "https:\/\/schema.org\/InStock",
            "url": "http:\/\/www.example.com\/product\/variable-widget\/?attribute_pa_color=red",
            "seller": {
                "@type": "Organization",
                "name": "WC Devbox",
                "url": "http:\/\/www.example.com"
            }
        }
    ]
},
{
    "@type": "Product",
    "@id": "http:\/\/www.example.com\/product\/variable-widget\/",
    "name": "Variable widget",
    "image": "http:\/\/www.example.com\/wp-content\/uploads\/2017\/10\/widget-grey.jpg",
    "description": "Lorem ipsum dolor sit amet, consectetur adipisicing elit.",
    "sku": "VARIABLEWIDGETSKU",
    "offers": [
        {
            "@type": "AggregateOffer",
            "lowPrice": "21.99",
            "highPrice": "27.99",
            "priceCurrency": "GBP",
            "availability": "https:\/\/schema.org\/InStock",
            "url": "http:\/\/www.example.com\/product\/variable-widget\/",
            "seller": {
                "@type": "Organization",
                "name": "WC Devbox",
                "url": "http:\/\/www.example.com"
            }
        }
    ]
}

```
