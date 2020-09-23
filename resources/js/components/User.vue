<template>
  <div class="container pt-5">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title pt-3">
              <div class="row">
                <h3 class="pl-2 pr-2">List User |</h3>
                <!-- Button trigger modal -->
                <button
                  type="button"
                  class="btn btn-sm btn-primary"
                  data-toggle="modal"
                  data-target="#modal-create-user"
                >
                  <i class="fas fa-plus-circle"></i> Create New User
                </button>
                <!-- <a class="pl-2 btn" data-toggle="modal" data-target="#staticBackdrop">
                  <i class="fas fa-plus-circle"></i> Create New User
                </a>-->
              </div>
            </div>
            <div class="card-tools pt-3">
              <div class="input-group input-group-md" style="width: 250px;">
                <input
                  type="text"
                  name="table_search"
                  class="form-control float-right"
                  placeholder="Search"
                />

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Type</th>
                  <th>Modify</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>183</td>
                  <td>John Doe</td>
                  <td>11-7-2014</td>
                  <td>
                    <span class="tag tag-success">Approved</span>
                  </td>
                  <td>
                    <a class="text-warning" href="#">
                      <i class="fas fa-pen"></i>
                    </a> |||
                    <a class="text-danger" href="#">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="modal-create-user"
      data-backdrop="static"
      data-keyboard="false"
      tabindex="-1"
      aria-labelledby="staticBackdropLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="createUser">
              <div class="form-group">
                <label>Name</label>
                <input
                  v-model="form.name"
                  type="text"
                  name="name"
                  autofocus="autofocus"
                  class="form-control"
                  placeholder="Your Name"
                  :class="{ 'is-invalid': form.errors.has('name') }"
                />
                <has-error :form="form" field="name"></has-error>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input
                  v-model="form.email"
                  type="email"
                  name="email"
                  class="form-control"
                  placeholder="Your Email"
                  :class="{ 'is-invalid': form.errors.has('email') }"
                />
                <has-error :form="form" field="email"></has-error>
              </div>
              <div class="form-group">
                <label>Your Bio</label>
                <textarea
                  v-model="form.bio"
                  name="bio"
                  id="bio"
                  placeholder="Optional"
                  cols="10"
                  rows="2"
                  class="form-control"
                  :class="{'is-invalid' : form.errors.has('bio')}"
                ></textarea>
              </div>
              <div class="form-group">
                <label>Select Role User</label>
                <select
                  name="type"
                  id="type"
                  v-model="form.type"
                  class="form-control"
                  :class="{'is-invalid':form.errors.has('type')}"
                >
                  <option readonly value>Select User Role</option>
                  <option value="admin">Admin</option>
                  <option value="user">Standart User</option>
                  <option value="author">Author</option>
                </select>
                <has-error :form="form" field="type"></has-error>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input
                  type="password"
                  name="password"
                  class="form-control"
                  id="password"
                  placeholder="Your Password"
                  :class="{'is-invalid':form.errors.has('password')}"
                />
                <has-error :form="form" field="password"></has-error>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Create</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { Form, HasError, AlertError } from "vform";
window.form = Form;
export default {
  name: "User",
  data() {
    return {
      form: new Form({
        name: "",
        email: "",
        password: "",
        type: "",
        bio: "",
        photo: "",
      }),
    };
  },
  methods: {
    createUser: function () {
      this.form.post("api/user");
    },
  },
};
</script>
