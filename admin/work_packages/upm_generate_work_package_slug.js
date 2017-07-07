jQuery(document).ready(function($) {
    //Auto generate id and slug
    $("#create-work-package").find("input[name='name']").keyup(autoFillSlug);
    function autoFillSlug() {
        var name = $("#create-work-package").find("input[name='name']");
        var slug = $("#create-work-package").find("input[name='slug']");
        /* replace spaces with "_", uppercase letters with lowercase */
        var nameValue = name.val().replace(/ +/g, "_").toLowerCase();
        slug.val(nameValue);
    }
});

jQuery(document).ready(function($) {
    $("#edit-work-package").find("input[name='name']").keyup(autoFillSlug);
    function autoFillSlug() {
        var name = $("#edit-work-package").find("input[name='name']");
        var slug = $("#edit-work-package").find("input[name='slug']");
        /* replace spaces with "_", uppercase letters with lowercase */
        var nameValue = name.val().replace(/ +/g, "_").toLowerCase();
        slug.val(nameValue);
    }
});