
jQuery(document).ready(function(){
  //request from cart page
    jQuery('input[type=number]').change(function () {
        var trId = jQuery(this).closest('tr');
        var product_id = trId.find("input[type='hidden']").val();
        var product_quantity = trId.find("input[type='number']").val();
        var product_price = trId.find("input[name='product_price']").val();

        jQuery(this).parents('tr').find(".item_total").text("€" +(product_quantity*product_price) );

        var subtotal = getSubTotal(this);

        addToCart(product_id,product_quantity);

    });
    jQuery('a.remove').click(function () {
        var trId = jQuery(this).closest('tr');
        var product_id = trId.find("input[type='hidden']").val();

        jQuery(this).closest('tr').remove();
        addToCart(product_id, 0);
    })

    // $( "#searchThis" ).click(function() {
    //     alert( jQuery("#searchTerm").val() );
    //
    //     event.preventDefault();
    //     searchThis(jQuery("#searchTerm").val());
    // });

});


function getSubTotal(table)
{

    var subTotalTable = jQuery('#totalTable').find('td.grandtotal').val();
    //var subTotalTable = document.getElementsByName('totalTable');
    var tabs = jQuery(table).closest('table').attr('id');
    var rowsCount = (jQuery('#cartTable tr').length);

    for (i = 1; i < rowsCount; i++)
    {
        var tds = [];
         tds[i] = jQuery(table).find("td.item_total");
    }

    console.log(tds);

// // LOOP THROUGH EACH ROW OF THE TABLE AFTER HEADER.
//     for (i = 1; i < myTab.rows.length; i++) {
//
//         // GET THE CELLS COLLECTION OF THE CURRENT ROW.
//         var objCells = myTab.rows.item(i).cells;
//
//         // LOOP THROUGH EACH CELL OF THE CURENT ROW TO READ CELL VALUES.
//         {
//             info.innerHTML = info.innerHTML + ' ' + objCells.item(2).innerHTML;
//         }
//         info.innerHTML = info.innerHTML + '<br />';     // ADD A BREAK (TAG).
//     }
}

function addToCart(pid, qty)
{
    //request coming from single product view page
    if (qty == undefined || qty == '')
    {
        product_quantity =  jQuery('select[id="product_quantity"]').val();
    }
    else
    {
        product_quantity = qty;
    }

    if (pid != null)
    {
        jQuery('.jQuery_msg').html(' <div class="alert alert-success fade-in alert-dismissible">' +
            '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">x</a>' +
            'Added</div>');
    }
    //alert(product_quantity);
    jQuery.ajax({
        url:'/addToCart',
        data:{
            'product_quantity': product_quantity,
            'product_id' : pid,
        },// jQuery('#shopping_cart').serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'post',
        success: function (result) {
             alert(result);
        }

    });

}

function sortData()
{
    var filterBy =  jQuery('select[id="sortOrder"]').val();
    var pid =  jQuery('input[type="hidden"]').val();

    jQuery('#sortCategoryFilters').submit();

}

function sortSearchResults()
{
sortSearchResultsBy = jQuery('#sortSearchResultsBy').val();
    jQuery('#sortSearchResults').submit();
// alert(sortSearchResultsBy);
//     jQuery.ajax({
//
//         url:'/search',
//         data:{
//             'sortSearchResultsBy': sortSearchResultsBy,
//
//         },// jQuery('#shopping_cart').serialize(),
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         type:'post',
//         success: function (result) {
//             console.log(result.datas);
//             window.location = result.redirectTo;
//         }
//
//     });

}

function searchThis(searchTerm)
{

    jQuery.ajax({

        url:'/search',
        data:{
            'searchTerm': searchTerm,

        },// jQuery('#shopping_cart').serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type:'post',
        success: function (result) {
            console.log(result);
        }

    });

}
