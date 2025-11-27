?>
<script>
// Auto hide alerts
setTimeout(function() {
    let alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        let bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
    });
}, 3000);

// Confirm delete
function confirmDelete(message) {
    return confirm(message || 'Bạn có chắc muốn xóa?');
}
</script>