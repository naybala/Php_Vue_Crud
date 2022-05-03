<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vue js PHP MySQLi Registration</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js"></script>
</head>

<body>
    <div class="container">
        <h1 class="page-header text-center">Vue js PHP MySQLi Registration</h1>
        <div id="vueregapp">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><span class="glyphicon glyphicon-user"></span> User Registration
                        </div>
                        <div class="panel-body">
                            <label>User Name:</label>
                            <input type="text" class="form-control" ref="username" v-model="regDetails.username"
                                v-on:keyup="keymonitor">
                            <div class="text-center" v-if="errorUsername">
                                <span style="font-size:13px;">{{ errorUsername }}</span>
                            </div>
                            <label>Email:</label>
                            <input type="text" class="form-control" ref="email" v-model="regDetails.email"
                                v-on:keyup="keymonitor">
                            <div class="text-center" v-if="errorEmail">
                                <span style="font-size:13px;">{{ errorEmail }}</span>
                            </div>
                            <label>Password:</label>
                            <input type="password" class="form-control" ref="password" v-model="regDetails.password"
                                v-on:keyup="keymonitor">
                            <div class="text-center" v-if="errorPassword">
                                <span style="font-size:13px;">{{ errorPassword }}</span>
                            </div>
                        </div>
                        <div class="panel-footer mt-1 mb-2">
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="button" @click="userReg();">Sign Up</button>
                            </div>
                        </div>
                    </div>

                    <div v-if="errorMessage">
                        <!-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div> -->
                    </div>

                    <div v-if="successMessage">
                        <!-- <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Holy guacamole!</strong> Success!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div> -->
                    </div>

                </div>

                <div class="col-md-6">
                    <h3>Users Table</h3>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <tr v-for="user in users">
                                <td>{{ user.user_name }}</td>
                                <td>{{ user.user_email }}</td>
                                <td>{{ user.user_password  }}</td>
                                <td><button type="button" name="delete" class="btn btn-danger btn-xs delete"
                                        @click="deleteData(user.user_id);">Delete</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="vue.js"></script>
</body>

</html>