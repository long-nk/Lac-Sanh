myApp.controller('customers', function ($scope, $apply, $timeout, $sce) {
    $scope.data = {};
    $scope.listCustomer = {};
    $scope.btnAddNewCustomer;
    $scope.customerInfo = {};
    $scope.showInfoCustomerModal = function (id) {
        sv.data.getCustomerInfo(id, function (response) {
            $apply(function () {
                $scope.customerInfo = response[0];
                $('#customerInfoModal').modal('show');
            });

        });
    };
    $scope.btnAddNewCustomer = function () {
        var data = {};
        data = $('#frmAddCustomer').serialize();
        sv.data.addCustomer(data, function (response) {
            if (response.status == "success") {
                alert('Thao tác thành công!');
                $('#addNewModal').modal('hide');
                window.location.reload();
                
            } else {
                alert('Thao tác thất bại, vui lòng kiểm tra lại!');
            }
        });
    };
    $scope.updateCustomerInfo = function(){
        var id = $('#frmUpdateCustomer').find('button.btnUpdateCustomer').attr('data-id');
        var data = $('#frmUpdateCustomer').serialize(); 
        sv.data.updateCustomerInfo(id, data, function(response){
           if (response.status == "success") {
               alert("Thao tác thành công!");
               $('#customerInfoModal').modal('hide');
               window.location.reload();
           }else{
               alert('Cập nhật thất bại!');
           }
        });
    };
    $scope.actionDelete = function (id) {
        var _token = $('input[name="_token"]').val();
        var url = SITE_ROOT + 'admin/deleteCustomers/';
        if (typeof id === 'undefined') {
            var arrid = [];
            $('#datatable-buttons').find('tbody input[type=checkbox]:checked:enabled').each(function () {
                arrid.push($(this).attr('data-id'));
            });
            $.each(arrid, function (key, value) {
                url = SITE_ROOT + 'admin/deleteUsers/' + value;
                deleteCustomers(url, _token);
            });
        }else {
            url += id;
            deleteCustomers(url, _token);
        } 
    };
    function deleteCustomers(url, _token) {
        sv.data.deleteCustomer(url, _token, function (response) {
            if (response.status == 'success') {
                alert("Thao tác thành công!");
                window.location.reload();
            } else {
                alert("Thao tác không thành công!");
            }

        });
    }
});
function btnChangeStatus(id) {
    var data = $('input[name="_token"]').val();
    var url = SITE_ROOT + 'admin/changeStatusCustomer/' + id;

    sv.data.changeStatusCustomer(url, data, function (response) {
        if (response.status == "success") {
            if (response.code == 1) {
                var html = '';
                html += '<button type="button" class="btn btn-round btn-success btn-xs btnChangeStatus' + id + '" onclick="btnChangeStatus(' + id + ')" >Active</button>';
                $('.btnChangeStatus' + id).replaceWith(html);
            } else {
                var html = '';
                html += '<button type="button" class="btn btn-round btn-danger btn-xs btnChangeStatus' + id + '" onclick="btnChangeStatus(' + id + ')">Not Active</button>';
                $('.btnChangeStatus' + id).replaceWith(html);
            }
        } else {
            alert('Lỗi không thể thay đổi trạng thái!');
        }
    });
}