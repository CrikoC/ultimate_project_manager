jQuery(document).ready(function($) {
    //Auto generate id and slug
    $("#create-milestone").find("input[name='name']").keyup(autoFillSlug);
    function autoFillSlug() {
        var name = $("#create-milestone").find("input[name='name']");
        var slug = $("#create-milestone").find("input[name='slug']");
        /* replace spaces with "_", uppercase letters with lowercase */
        var nameValue = name.val().replace(/ +/g, "_").toLowerCase();
        slug.val(nameValue);
    }
});

jQuery(document).ready(function($) {
    $("#edit-milestone").find("input[name='name']").keyup(autoFillSlug);
    function autoFillSlug() {
        var name = $("#edit-milestone").find("input[name='name']");
        var slug = $("#edit-milestone").find("input[name='slug']");
        /* replace spaces with "_", uppercase letters with lowercase */
        var nameValue = name.val().replace(/ +/g, "_").toLowerCase();
        slug.val(nameValue);
    }
});
