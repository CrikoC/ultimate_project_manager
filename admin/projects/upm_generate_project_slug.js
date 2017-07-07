jQuery(document).ready(function($) {
    //Auto generate id and slug
    $("#create-project").find("input[name='name']").keyup(autoFillSlug);
    function autoFillSlug() {
        var name = $("#create-project").find("input[name='name']");
        var slug = $("#create-project").find("input[name='slug']");
        /* replace spaces with "_", uppercase letters with lowercase */
        var nameValue = name.val().replace(/ +/g, "_").toLowerCase();
        slug.val(nameValue);
    }
});



jQuery(document).ready(function($) {
    //Auto generate id and slug
    $("#edit-project").find("input[name='name']").keyup(autoFillSlug);
    function autoFillSlug() {
        var name = $("#edit-project").find("input[name='name']");
        var slug = $("#edit-project").find("input[name='slug']");
        /* replace spaces with "_", uppercase letters with lowercase */
        var nameValue = name.val().replace(/ +/g, "_").toLowerCase();
        slug.val(nameValue);
    }
});