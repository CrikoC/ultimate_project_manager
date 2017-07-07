jQuery(document).ready(function($) {
    //Auto generate id and slug
    $("#create-deliverable").find("input[name='name']").keyup(autoFillSlug);
    function autoFillSlug() {
        var name = $("#create-deliverable").find("input[name='name']");
        var slug = $("#create-deliverable").find("input[name='slug']");
        /* replace spaces with "_", uppercase letters with lowercase */
        var nameValue = name.val().replace(/ +/g, "_").toLowerCase();
        slug.val(nameValue);
    }


});

jQuery(document).ready(function($) {
    $("#edit-deliverable").find("input[name='name']").keyup(autoFillSlug);
    function autoFillSlug() {
        var name = $("#edit-deliverable").find("input[name='name']");
        var slug = $("#edit-deliverable").find("input[name='slug']");
        /* replace spaces with "_", uppercase letters with lowercase */
        var nameValue = name.val().replace(/ +/g, "_").toLowerCase();
        slug.val(nameValue);
    }
});