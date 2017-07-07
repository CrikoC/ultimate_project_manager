jQuery(document).ready(function($) {
    //Auto generate id and slug
    $("#create-task").find("input[name='name']").keyup(autoFillSlug);
    function autoFillSlug() {
        var name = $("#create-task").find("input[name='name']");
        var slug = $("#create-task").find("input[name='slug']");
        /* replace spaces with "_", uppercase letters with lowercase */
        var nameValue = name.val().replace(/ +/g, "_").toLowerCase();
        slug.val(nameValue);
    }


});

jQuery(document).ready(function($) {
    $("#edit-task").find("input[name='name']").keyup(autoFillSlug);
    function autoFillSlug() {
        var name = $("#edit-task").find("input[name='name']");
        var slug = $("#edit-task").find("input[name='slug']");
        /* replace spaces with "_", uppercase letters with lowercase */
        var nameValue = name.val().replace(/ +/g, "_").toLowerCase();
        slug.val(nameValue);
    }
});