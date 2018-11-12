$(function() {
    if (localStorage.getItem('push-menu.collapsed') !== 'true') {
        $('.sidebar-mini').removeClass('sidebar-collapse');
    } else {
        $('.sidebar-mini').addClass('sidebar-collapse');
    }
    $('.navbar .sidebar-toggle[data-toggle=push-menu]').click(function() {
        localStorage.setItem('push-menu.collapsed', localStorage.getItem('push-menu.collapsed') !== 'true');
    });
});
