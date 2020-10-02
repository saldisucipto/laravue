<template>
  <div class="container">
    <div class="row justify-content-center" v-if="$gate.isAdmin()">
      <div class="col-12">
        <div
          class="alert alert-success alert-dismissible fade"
          role="alert"
          :class="{ show: isActive }"
        >
          <strong>Selamat</strong>
          {{ message }}
          <button
            type="button"
            class="close"
            data-dismiss="alert"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
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
                  @click="newModal"
                >
                  <i class="fas fa-plus-circle"></i> Create New User
                </button>
                <!-- <a class="pl-2 btn" data-toggle="modal" data-target="#staticBackdrop">
                  <i class="fas fa-plus-circle"></i> Create New User
                </a>-->
              </div>
            </div>
            <div class="card-tools pt-3">
              <div class="input-group input-group-md" style="width: 250px">
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
                  <th>Register At</th>
                  <th>Modify</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in users" :key="user.id">
                  <td>{{ user.id }}</td>
                  <td>{{ user.name }}</td>
                  <td>{{ user.email }}</td>
                  <td>
                    <span class="tag tag-success">{{ user.type }}</span>
                  </td>
                  <td>{{ user.created_at | myData }}</td>
                  <td>
                    <a class="text-warning" href="#" @click="editModal(user)">
                      <i class="fas fa-pen"></i>
                    </a>
                    |||
                    <a
                      class="text-danger"
                      href="#"
                      @click="deleteUser(user.id)"
                    >
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
            <h5 class="modal-title" v-show="!editMode" id="staticBackdropLabel">Create New User</h5>
            <h5 class="modal-title" v-show="editMode" id="staticBackdropLabel">Edit User</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="editMode ? updateUser() : createUser()" id="form">
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
                  v-show="!editMode"
                  type="email"
                  name="email"
                  class="form-control"
                  placeholder="Your Email"
                  :class="{ 'is-invalid': form.errors.has('email') }"
                />
                <input
                  v-model="form.email"
                  v-show="editMode"
                  type="email"
                  name="email"
                  class="form-control"
                  readonly
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
                  :class="{ 'is-invalid': form.errors.has('bio') }"
                ></textarea>
              </div>
              <div class="form-group">
                <label>Select Role User</label>
                <select
                  name="type"
                  id="type"
                  v-model="form.type"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('type') }"
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
                  v-model="form.password"
                  type="password"
                  name="password"
                  class="form-control"
                  id="password"
                  placeholder="Your Password"
                  :class="{ 'is-invalid': form.errors.has('password') }"
                />
                <has-error :form="form" field="password"></has-error>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" v-show="!editMode" class="btn btn-primary">Create</button>
                <button type="submit" v-show="editMode" class="btn btn-warning">Save</button>
              </div>
            </form>
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
      users: {},
      form: new Form({
        id: "",
        name: "",
        email: "",
        password: "",
        type: "",
        bio: "",
        photo: "",
      }),
      message: "",
      isActive: false,
      editMode: false,
    };
  },
  methods: {
    updateUser(id) {
      //console.log("updating Data");
      this.$Progress.start();
      this.form
        .put("api/user/" + this.form.id)
        .then(() => {
          //succes
          $("#modal-create-user").modal("hide");
          this.loadData();
          swal.fire("Updated!", "Your Information Has Updated.", "success");
        })
        .catch(() => {
          this.$Progress.fail();
        });
      this.$Progress.finish();
    },
    editModal(user) {
      $("#form").trigger("reset");
      $("#modal-create-user").modal("show");
      this.editMode = true;
      this.form.fill(user);
    },

    newModal() {
      $("#form").trigger("reset");
      $("#modal-create-user").modal("show");
    },
    deleteUser(id) {
      swal
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!",
        })
        .then((result) => {
          // send request to server
          this.form
            .delete("api/user/" + id)
            .then(() => {
              if (result.isConfirmed) {
                swal.fire("Deleted!", "Your file has been deleted.", "success");
                this.loadData();
              }
            })
            .catch(() => {
              swal("Failed!", "There was something wronge.", "warning");
            });
        });
    },
    createUser() {
      this.$Progress.start();
      this.form
        .post("api/user")
        .then((resp) => {
          var item = resp.data;
          this.message = resp.data.message;
          this.isActive = false;
          this.loadData();
        })
        .finally(() => {
          $("#form").trigger("reset");
          $("#modal-create-user").modal("hide");
        });
      this.$Progress.finish();
      toast.fire({
        icon: "success",
        title: "Berhasil Menmabahkan User Baru",
      });
    },

    loadData() {
      if (this.$gate.isAdmin()) {
        axios.get("api/user").then(({ data }) => (this.users = data.data));
      }
    },
  },
  created() {
    this.loadData();
  },
};
</script>
