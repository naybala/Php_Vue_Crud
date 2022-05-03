var app = new Vue({
    el: '#vueregapp',
    data:{
        successMessage: "",
        errorMessage: "",
        errorUsername: "",
        errorEmail: "",
        errorPassword: "",
        users: [],
        regDetails: {username: '', email: '', password: ''},
    },
  
    mounted: function(){
        this.getAllUsers();
    },
  
    methods:{
        getAllUsers: function(){
            axios.get('action.php')
                .then(function(response){
                    if(response.data.error){
                        app.errorMessage = response.data.message;
                    }
                    else{
                        app.users = response.data.users;
                    }
                });
        },
  
        userReg: function(){
            var regForm = app.toFormData(app.regDetails);
            axios.post('action.php?action=register', regForm)
                .then(function(response){
                    console.log(response);
                    if(response.data.username){
                        app.errorUsername = response.data.message;
                        app.focusUsername();
                        app.clearMessage();
                    }
                    else if(response.data.email){
                        app.errorEmail = response.data.message;
                        app.focusEmail();
                        app.clearMessage();
                    }
                    else if(response.data.password){
                        app.errorPassword = response.data.message;
                        app.errorEmail='';
                        app.focusPassword();
                        app.clearMessage();
                    }
                    else if(response.data.error){
                        app.errorMessage = response.data.message;
                        app.errorEmail='';
                        app.errorPassword='';
                    }
                    else{
                        app.successMessage = response.data.message;
                        app.regDetails = {email: '', password:''};
                        app.errorEmail='';
                        app.errorPassword='';
                        app.getAllUsers();
                    }
                });
        },
  
        focusUsername: function(){
            this.$refs.username.focus();
        },      
         
        focusEmail: function(){
            this.$refs.email.focus();
        },
  
        focusPassword: function(){
            this.$refs.password.focus();
        },
  
        keymonitor: function(event) {
            if(event.key == "Enter"){
                app.userReg();
            }
        },
  
        toFormData: function(obj){
            var form_data = new FormData();
            for(var key in obj){
                form_data.append(key, obj[key]);
            }
            return form_data;
        },
  
        clearMessage: function(){
            app.errorMessage = '';
            app.successMessage = '';
        },
         
        deleteData: function(user_id){ //alert(user_id)
            if(confirm("Are you sure you want to remove this data?")){ 
                axios.post('action.php?action=delete&id='+ user_id +'', {
                 action:'delete',
                }).then(function(response){
                    alert(response.data.message);
                    app.getAllUsers();
                });
            }
        }
  
    }
});