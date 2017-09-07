jQuery(document).ready(function($) {
    //Auto generate id and slug
    $("#create-notice").find("input[name='name']").keyup(autoFillSlug);
    function autoFillSlug() {
        var name = $("#create-notice").find("input[name='name']");
        var slug = $("#create-notice").find("input[name='slug']");
        /* replace spaces with "_", uppercase letters with lowercase */
        var nameValue = name.val().replace(/ +/g, "_").toLowerCase();
        slug.val(nameValue);
    }


});

jQuery(document).ready(function($) {
    $("#edit-notice").find("input[name='name']").keyup(autoFillSlug);
    function autoFillSlug() {
        var name = $("#edit-notice").find("input[name='name']");
        var slug = $("#edit-notice").find("input[name='slug']");
        /* replace spaces with "_", uppercase letters with lowercase */
        var nameValue = name.val().replace(/ +/g, "_").toLowerCase();
        slug.val(nameValue);
    }
});