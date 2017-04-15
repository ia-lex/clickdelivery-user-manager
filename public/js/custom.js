(function() {
    function loadUser() {};
    function deleteUser() {};
    function showModal() {};
})();

function loadUser(user) {
    $('#manager-modal #name').val(user.name);
    $('#manager-modal #email').val(user.email);
    $('#manager-modal #phone_number').val(user.phone_number);
    $('#manager-modal #role_id').val(user.role_id);
    $('#manager-modal #able_to_read').prop("checked", user.able_to_read);
    $('#manager-modal #activate').prop("checked", user.activate);
    $('#manager-modal #id').val(user.id);    
}

function deleteUser(user) {
    $('#delete-modal #id').val(user.id);
}

function showModal() {
    $('#manager-modal').modal('show'); 
}