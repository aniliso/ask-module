PNotify.prototype.options.styling = "bootstrap3";
Vue.component('pnotify', {
    props: ['type', 'title', 'content'],
    template: `
   <script>
   new PNotify({
        text: '{{ content }}',
        type: '{{ type }}'
    });
   </script>`
});

new Vue({
    el: '#ask',
    data: {
        formInputs: {},
        formErrors: {},
        loading: false,
        success: false,
        error: false
    },
    components: {
        'alert-box': {
            props: ['type', 'message'],
            template: '#alert-box-message'
        }
    },
    methods: {
        onFileChange: function (e) {
            e.preventDefault();
            var files = e.target.files || e.dataTransfer.files;
            this.formInputs.attachment = files[0];
        },
        submitForm: function (e) {
            e.preventDefault();
            this.success = false;
            this.error = false;
            this.ajaxStart(true);
            var form = e.srcElement;
            var action = form.action;
            var csrfToken = form.querySelector('input[name="_token"]').value;
            this.formInputs.captcha_ask = grecaptcha.getResponse(captcha_ask);
            var formData = new FormData();
            for (var key in this.formInputs) {
                formData.append(key, this.formInputs[key]);
            }
            this.$http.post(action, formData, {
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Cache-Control': 'no-cache'
                }
            }).then(function (response) {
                this.ajaxStart(false);
                $('#askModal').modal('hide');
                this.formInputs = {};
                this.success = true;
                this.resetForm();
                $('.fileinput').fileinput('reset');
            }).catch(function (data, status, request) {
                var errors = data.data;
                this.formErrors = (typeof errors !== 'undefined') ? errors.message : {};
                this.ajaxStart(false);
                grecaptcha.reset(captcha_ask);
            });
        },
        modalClose: function () {
            this.resetForm();
            this.formErrors = {};
            grecaptcha.reset(captcha_ask);
        },
        resetForm: function () {
            $('#guestbook').trigger('reset');
        },
        ajaxStart: function (loading) {
            if (loading) {
                $('#ask').LoadingOverlay("show");
            } else {
                $('#ask').LoadingOverlay("hide");
            }
        }
    }
});