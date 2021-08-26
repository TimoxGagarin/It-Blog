$(function () {
    $('ul.categories-list').on('click', 'li:not(.active)', function (e) {
        e.preventDefault();
        $(this).addClass('active').siblings().removeClass('active');
    });
});