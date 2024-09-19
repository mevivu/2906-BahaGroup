<script>
$(document).ready(function() {
    $('.color-btn, .capacity-btn').click(function() {
        var attributeName = $(this).data('attribute-name');
        var attributeId = $(this).data('attribute-id');
        var attributeVariationId = $(this).data('attribute-variation-id');
        let hiddenAttributeValues = [];
        const elements = document.querySelectorAll("#hiddenAttribute");

        $('#attribute_variation_name' + attributeId).text(attributeName);

        $('input[name="attribute_variation_ids[' + attributeId + ']"]').val(attributeVariationId);

        elements.forEach(element => {
            hiddenAttributeValues.push(element.value);
        });
        const hasEmpty = hiddenAttributeValues.some(value => value === '');
        if (!hasEmpty) {

            $.ajax({
                type: "GET",
                url: '{{ route('user.product.findVariationByAttributeVariationIds') }}',
                data: { attribute_variation_ids: hiddenAttributeValues, product_id: $('input[name="hidden_product_id"]').val() },
                success: function(response){
                    $('#productVariationPrice').text(response.data.price);
                    $('#productVariationPromotionPrice').text(response.data.promotion_price);
                    if(response.data.qty == 0){
                        $('#instock').text(`Hết hàng`);
                    }
                    else{
                        $('#instock').text(`còn ${response.data.qty} hàng`);
                        $('input[name="hidden_quantity"]').val(response.data.qty);

                        $('#btnAddToCart').removeAttr('disabled');
                        $('#btnBuyNow').removeAttr('disabled');
                        $('#btnIncrement').removeAttr('disabled');
                        $('#btnDecrement').removeAttr('disabled');
                    }
                },
                error: function(response){
                    handleAjaxError(response);
                }
            })
        }
    });
});
</script>
