"use strict";
/// <reference path="form-namespace.ts"/>
var Form;
(function (Form) {
    class MyForm {
        constructor(email) {
            this.email = email;
            this.type = "inline";
            this.state = "active";
        }
        getInfo() {
            return {
                type: this.type,
                state: this.state
            };
        }
    }
    Form.myForm = new MyForm("v@mail.com");
})(Form || (Form = {}));
console.log("Form ", Form.myForm);
//# sourceMappingURL=namespaces.js.map