export default {
    params: ['complete', 'id'],
    directive: {
        ajax
    }
}

export const ajax = {
    bind: function () {
        this.el.addEventListener(
            'submit', this.onSubmit.bind(this)
        );
    },

    onSubmit: function (e) {
        e.preventDefault();
        let button = this.el.querySelector('button[type="submit"]');
        button.disabled = true;

        let formData = new FormData(this.el)
        let formInstance = this.el
        this.vm.$http[this.getRequestType()](this.el.action, formData)
            .then(function (response) {

                let response_message = response.data.message
                let message = '';
                if (typeof response_message === 'object') {
                    for (var key in response_message) {
                        if (response_message.hasOwnProperty(key)) {
                            message += key + " : " + response_message[key] + " <br> ";
                        }
                    }
                }
                else {
                    message = response.data.message;
                }

                if (response.data.success) {
                    formInstance.reset();

                    // show success message here
                }

                button.disabled = false;
            })
    },
    getRequestType: function () {
        var method = this.el.querySelector('input[name="_method"]');

        return (method ? method.value : this.el.method).toLowerCase();
    },
}
