new Vue({
    el: '#app',
    data() {
        return {
            name: '',
            gender: '',
            birth: '',
            post: '',
            address: '',
            phone: '',
            email: '',
            kind: '',
            content: ''
        }
    },
    computed: {
        isInValidName() {
            return this.name.length <5
        },
        isInValidGender() {
            return this.gender.length == 0
        },
        isInValidBirth() {
            return this.birth.length == 0
        },
        isInValidPost() {
            return this.post.length < 7
        },
        isInValidAddress() {
            return this.address.length == 0
        },
        isInValidAddress() {
            return this.address.length > 200
        },
        isInValidEmail() {
            return this.email.length > 200
        },
        isInValidKind() {
            return this.kind.length == 0
        },
        isInValidContent() {
            return this.content.length == 0
        },
        isInValidContent() {
            return this.content.length > 1000
        }
    },
})