function actionForm(selector) {
    switch (selector)
    {
        case 'register_btn':
            hideShow('.login-form', '.register-form');
            break;
        case 'register_back_btn':
            hideShow('.register-form', '.login-form');
            break;
        case 'forget_password':
            hideShow('.login-form', '.forget-form');
            break;
        case 'back_btn':
            hideShow('.forget-form', '.login-form');
            break;
        default:
            break;
    }
}
function hideShow(hide, show) {
    $(hide).hide(400);
    $(show).show(400);
}