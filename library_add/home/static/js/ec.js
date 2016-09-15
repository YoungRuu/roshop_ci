function viewProduct(product) {
    obj = {            // Provide product details in an impressionFieldObject.
      'id': product.sku,                   // Product ID (string).
      'name': product.name, // Product name (string).
      'category': product.category_name,   // Product category (string).
    };
    if (product.list) {
      obj.list = product.list;
    }
    
    ga('ec:addImpression', obj);
    ga('ec:setAction', 'detail');       // Detail action.
    ga('send', 'pageview');

    fbq('track', 'ViewContent');
}

function cartProduct(product) {
    ga('ec:addProduct', {
        'id': product.sku,
        'name': product.name,
        'category': product.category_name,
        'variant': product.color.name,
        'price': product.price,
        'quantity': product.quantity
    });
    ga('ec:setAction', product.action);
    
    if (product.action == 'add') {
        ga('send', 'event', 'UX', 'click', 'add to cart');
        //facebook addtocart
        fbq('track', 'AddToCart');
    } else if (product.action == 'remove') {
        ga('send', 'event', 'UX', 'click', 'remove from cart');
    }
    
}

function cartCheckout() {
    //facebook checkout
    fbq('track', 'InitiateCheckout');

    $.ajax({
        url: '/index.php?route=checkout/cart/ajaxGetCartData&_=' + Date.now(),
        type: 'GET',
        dataType: "json",
        cache: false,
        success: function (data) {
            if (data.cartCount > 0) {
                for(var i = 0; i < data.cartCount; i++) {
                    var product = data.products[i];
                    ga('ec:addProduct', {
                      'id': product.sku,
                      'name': product.name,
                      'category': product.category_name,
                      'variant':  product.color,
                      'price': product.price,
                      'quantity': product.quantity
                    });
                }
                ga('ec:setAction','checkout');
                ga('send', 'event', 'Checkout');
            }
        }
    });
}

function cartRemove() {
    $.ajax({
        url: '/index.php?route=checkout/cart/ajaxGetCartData&_=' + Date.now(),
        type: 'GET',
        dataType: "json",
        cache: false,
        success: function (data) {
            if (data.cartCount > 0) {
                for(var i = 0; i < data.cartCount; i++) {
                    var product = data.products[i];
                    ga('ec:addProduct', {
                      'id': product.sku,
                      'name': product.name,
                      'category': product.category_name,
                      'variant':  product.color,
                      'price': product.price,
                      'quantity': product.quantity
                    });
                }
                ga('ec:setAction','remove');
                ga('send', 'event', 'UX', 'click', 'remove from cart');
            }
            window.location.href = '/index.php?route=checkout/cart/clear';
        }
    });
}

function clickProduct(product) {
    ga('ec:addProduct', {
      'id': product.sku,
      'name': product.name,
      'category': product.category_name,
      'position': product.position
    });
    ga('ec:setAction', 'click', {list: product.list});
    // Send click with an event, then send user to product page.
    ga('send', 'event', 'UX', 'click', {
        hitCallback: function() {
          document.location = product.href+'?fl='+product.list;
        }
    });
}

function cartPurchase() {
  $.ajax({
      url: '/index.php?route=checkout/cart/ajaxGetCartData&_=' + Date.now(),
      type: 'GET',
      dataType: "json",
      cache: false,
      success: function (data) {
          if (data.cartCount > 0) {
              for(var i = 0; i < data.cartCount; i++) {
                  var product = data.products[i];
                  ga('ec:addProduct', {
                    'id': product.sku,
                    'name': product.name,
                    'category': product.category_name,
                    'variant':  product.color,
                    'price': product.price,
                    'quantity': product.quantity
                  });
              }
              ga('ec:setAction', 'purchase', {
                id: $('.form-checkout').uniqueId(),
                affiliation: 'MAZA - Online',
                revenue: data.total,
              });

              //facebook purchase
              fbq('track', 'Purchase', {value: data.total, currency: 'VND'});

              ga('send', 'pageview', {
                'hitCallback': function() {
                  $('.form-checkout').removeAttr('data-call-back');
                  $('.form-checkout').submit();
                }
              });
          }
      }
  });
}