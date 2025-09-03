var sv = {};

//--------------------------- OBJECT ----------------------------
sv.url = {};
sv.data = {};
sv.captcha = {};

//--------------------------- CONFIG URL ----------------------------

sv.url.base = SITE_ROOT + 'api/data/';
sv.captcha.base = SITE_ROOT + 'api/captcha/index/';

sv.url.getService = function (method)
{
    return sv.url.base + method;
};
sv.url.getCaptcha = function (method)
{
    return sv.captcha.base + method;
};

//--------------------------------AJAX-------------------------------------
sv.data.getData = function (url,  data, afuntion, async) {
    $.ajax({
        method: 'POST',
        url: url,
        data: data,
        async: async,
        dataType: "json",
        success: function (response) {
            if (typeof afuntion == 'string')
            {
                window[afuntion](response);
            }
            else
            {
                (afuntion)(response);
            }

        }
    });
}
//-------------------------------- FUNCTION -------------------------------------
sv.data.getAllProducts = function (afunction, async){
    var data = {};
    if(typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('getAllProducts'), data, afunction, async);
}
//----------User
sv.data.addUser = function (data, afunction, async){
    var data = data;
    if(typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('addUser'), data, afunction, async);
};
sv.data.getUserInfo = function (id, afunction, async){
    var data = {};
    if(typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('getUserInfo') + '/' + id, data, afunction, async);
};
sv.data.updateUserInfo = function (id, data, afunction, async){
    var data = data;
    if(typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('updateUserInfo') + '/' + id, data, afunction, async);
};
sv.data.changeStatusUser = function (url, _token, afunction, async){
    var data = {
        _token: _token
    };
    if(typeof async == 'undefined')
        async = true;
    sv.data.getData(url, data, afunction, async);
};
sv.data.deleteUser = function (url, _token, afunction, async){
    var data = {
        _token: _token
    };
    if(typeof async == 'undefined')
        async = true;
    sv.data.getData(url, data, afunction, async);
};

//----------Customer
sv.data.addCustomer = function (data, afunction, async){
    var data = data;
    if(typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('addCustomer'), data, afunction, async);
};
sv.data.getCustomerInfo = function (id, afunction, async){
    var data = {};
    if(typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('getCustomerInfo') + '/' + id, data, afunction, async);
};
sv.data.updateCustomerInfo = function (id, data, afunction, async){
    var data = data;
    if(typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('updateCustomerInfo') + '/' + id, data, afunction, async);
};
sv.data.changeStatusCustomer = function (url, _token, afunction, async){
    var data = {
        _token: _token
    };
    if(typeof async == 'undefined')
        async = true;
    sv.data.getData(url, data, afunction, async);
};
sv.data.deleteCustomer = function (url, _token, afunction, async){
    var data = {
        _token: _token
    };
    if(typeof async == 'undefined')
        async = true;
    sv.data.getData(url, data, afunction, async);
};

//---------------Menu
sv.data.menu = function (afunction, async) {
    var data = {};
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getService('get_menu'), data, afunction, async);
};

//------------------------------------ BUILD URL---------------------------------------
sv.url.build_article = function (cat_slug, art_slug, website_id, cat_id, art_id) {
    return SITE_ROOT + 'tin-bai/' + cat_slug + '/' + art_slug + '/' + website_id + '-' + cat_id + '-' + art_id;
};

sv.url.build_category = function (cat_slug, website_id, cat_id) {
    return SITE_ROOT + 'chuyen-muc/' + cat_slug + '/' + website_id + '-' + cat_id;
};

sv.url.build_list_category = function (cat_slug, website_id, cat_id) {
    return SITE_ROOT + 'ds-chuyen-muc/' + website_id + '-' + cat_id + '/' + cat_slug;
};

//Upload file
sv.url.upload_file = function (file_name) {
    return SITE_ROOT + 'upload' + file_name;
};

sv.url.public_images = function (file_name) {
    return SITE_ROOT + 'public/images/' + file_name;
};

//-------------lay danh sach tin bai noi bat------------------
sv.data.sticky = function (afunction, async) {
    var data = {};
    if (typeof async == 'undefined')
        async = true;

    sv.data.getData(sv.url.getService('get_sticky'), data, afunction, async);
};

/**
 * chi tiet tin bai
 * @param {type} cat_id
 * @param {type} art_id
 * @param {type} afunction
 * @param {type} async
 * @returns {undefined}
 */
sv.data.article = function (cat_id, art_id, afunction, async) {
    var data = {
        category_id: cat_id,
        article_id: art_id
    };
    if (typeof async == 'undefined')
        async = true;

    sv.data.getData(sv.url.getService('get_article'), data, afunction, async);
};

/**
 * tin khac
 * @param {type} cat_id
 * @param {type} art_id
 * @param {type} afunction
 * @param {type} async
 * @returns {undefined}
 */
sv.data.other_article = function (cat_id, art_id, afunction, async) {
    var data = {
        category_id: cat_id,
        article_id: art_id
    };
    if (typeof async == 'undefined')
        async = true;

    sv.data.getData(sv.url.getService('get_other_article'), data, afunction, async);
};

/**
 * tin bai cua chuyen muc
 */
sv.data.art_of_cat = function (page, cat_id, key_word, afunction, async) {
    var data = {
        category_id: cat_id,
        page: page,
        key_word: key_word
    };
    if (typeof async == 'undefined')
        async = true;

    sv.data.getData(sv.url.getService('get_art_of_cat_by_page'), data, afunction, async);
};


//---------------------Data---------------------
sv.data.getAllCitys = function (afunction, async, objMethod) {
    var data = {};
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getEhrService('getAllCitys'), data, afunction, async, objMethod);
};

sv.data.getAllJobs = function (afunction, async, objMethod) {
    var data = {};
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getEhrService('getAllJobs'), data, afunction, async, objMethod);
};


sv.data.checkRegister = function (secret, security, afunction, async, objMethod) {
    var data = {
        secret: secret,
        security: security,
    }
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getEhrService('checkRegister'), data, afunction, async, objMethod);
};

sv.data.getRegisterInfo = function (secret, security, afunction, async, objMethod) {
    var data = {
        secret: secret,
        security: security
    }
    console.log(data);
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getEhrService('getRegisterInfo'), data, afunction, async, objMethod);
};

sv.data.getPersonInfo = function (loginName, passWord, afunction, async, objMethod) {
    var data = {
        loginName: loginName,
        passWord: passWord
    };
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getEhrService('getPersonInfo'), data, afunction, async, objMethod);
};

sv.data.logout = function (afunction, async, objMethod) {
    var data = {};
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getEhrService('logout'), data, afunction, async, objMethod);
};

sv.data.getListRegister = function (data, afunction, async, objMethod) {
    if (typeof async == 'undefined')
        async = true;

    sv.data.getData(sv.url.getEhrService('getListRegister'), data, afunction, async, objMethod);
};

sv.data.changePassWord = function (userName, oldPssWrd, newPssWrd, cfrmPssWrd, afunction, async, objMethod) {
    if (typeof async == 'undefined')
        async = true;
    var data = {
        userName: userName,
        oldPssWrd: oldPssWrd,
        newPssWrd: newPssWrd,
        cfrmPssWrd: cfrmPssWrd
    };
    sv.data.getData(sv.url.getEhrService('changePassWord'), data, afunction, async, objMethod);
};

sv.data.updatePersonInfo = function (data, afunction, async, objMethod) {
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getEhrService('updatePersonInfo'), data, afunction, async, objMethod);
};


/**
 * ------------------------------------------------------- captcha ------------------------------------------------------- 
 */

sv.captcha.getInfo = function (afunction, async, objMethod) {
    var data = {};
    if (typeof async == 'undefined')
        async = true;
    sv.data.getData(sv.url.getCaptcha('getInfo'), data, afunction, async, objMethod);
}

