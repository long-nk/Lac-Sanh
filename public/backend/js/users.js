myApp.controller('content_users', function ($scope, $apply, $timeout, $sce) {
    $scope.data = {};
    $scope.listProducts = {};
    $scope.btnAddNewUser;
    $scope.userInfo = {};
    var userInfo = {};
    $scope.showInfoUserModal = function (id) {
        sv.data.getUserInfo(id, function (response) {
            $apply(function () {
                $scope.userInfo = response[0];
                $('#userInfoModal').modal('show');
            });

        });
    };
    $scope.btnAddNewUser = function () {
        var data = {};
        data = $('#frmAddUser').serialize();
        sv.data.addUser(data, function (response) {
            if (response.status == "fail") {
                alert('Thao tác thất bại, vui lòng kiểm tra lại!');
            } else {
                alert('Thao tác thành công!');
                $('#addNewModal').modal('hide');
                window.location.reload();
            }
        });
    };
    $scope.updateUserInfo = function () {
        var id = $('#frmUpdateUser').find('button.btnUpdateUser').attr('data-id');
        var data = $('#frmUpdateUser').serialize();
        sv.data.updateUserInfo(id, data, function (response) {
            if (response.status == "success") {
                alert("Thao tác thành công!");
                $('#userInfoModal').modal('hide');
                window.location.reload();
            } else {
                alert('Cập nhật thất bại!');
            }
        });
    };
    $scope.actionDelete = function (id) {
        var _token = $('input[name="_token"]').val();
        var url = SITE_ROOT + 'admin/users/deleteUsers/';
        if (typeof id === 'undefined') {
            var arrid = [];
            $('#datatable-buttons').find('tbody input[type=checkbox]:checked:enabled').each(function () {
                arrid.push($(this).attr('data-id'));
            });
            $.each(arrid, function (key, value) {
                url = SITE_ROOT + 'admin/users/deleteUsers/' + value;
                deleteUsers(url, _token);
            });
        }else {
            url += id;
            deleteUsers(url, _token);
        } 
    };
    function deleteUsers(url, _token) {
        sv.data.deleteUser(url, _token, function (response) {
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
    var url = SITE_ROOT + 'admin/changeStatusUser/' + id;

    sv.data.changeStatusUser(url, data, function (response) {
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