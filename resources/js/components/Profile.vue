<template>
  <div class="container pt-5">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="card card-widget widget-user">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div
            class="widget-user-header bg-info"
            style="background-image: url('./img/usr-cover.jpg')"
          >
            <h3 class="widget-user-username">{{form.name}}</h3>
            <h5 class="widget-user-desc">{{form.type}}</h5>
          </div>
          <div class="widget-user-image">
            <img class="img-circle elevation-2" :src="getProfilePhoto()" alt="User Avatar" />
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header">3,200</h5>
                  <span class="description-text">SALES</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <h5 class="description-header">13,000</h5>
                  <span class="description-text">FOLLOWERS</span>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4">
                <div class="description-block">
                  <h5 class="description-header">35</h5>
                  <span class="description-text">PRODUCTS</span>
                </div>
                <!-- /.description-block -->
              </div>
            </div>
            <!-- /.row -->
          </div>
        </div>
      </div>
      <!-- /.col -->
      <div class="col-md-10">
        <div class="card">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item">
                <a class="nav-link" href="#activity" data-toggle="tab">Activity</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#settings" data-toggle="tab">Settings</a>
              </li>
            </ul>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane active" id="settings">
                <form class="form-horizontal">
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input
                        type="email"
                        class="form-control"
                        :class="{ 'is-invalid' : form.errors.has('name')}"
                        id="inputName"
                        placeholder="Name"
                        name="name"
                        v-model="form.name"
                      />
                      <has-error :form="form" field="name"></has-error>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                      <input
                        type="email"
                        v-model="form.email"
                        :class="{ 'is-invalid' : form.errors.has('email')}"
                        class="form-control"
                        id="inputEmail"
                        name="email"
                        placeholder="Email"
                        readonly
                      />
                      <has-error :form="form" field="email"></has-error>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputExperience" class="col-sm-2 col-form-label">Bio</label>
                    <div class="col-sm-10">
                      <textarea
                        class="form-control"
                        v-model="form.bio"
                        name="bio"
                        id="inputExperience"
                        placeholder="Experience"
                      ></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputSkills" class="col-sm-2 col-form-label">User Type</label>
                    <div class="col-sm-10">
                      <input
                        readonly
                        v-model="form.type"
                        type="text"
                        class="form-control"
                        name="type"
                        id="inputSkills"
                        placeholder="Skills"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Update Password</label>
                    <div class="col-sm-10">
                      <input
                        v-model="form.password"
                        type="password"
                        name="password"
                        :class="{ 'is-invalid' : form.errors.has('password')}"
                        class="form-control"
                        id="password"
                        placeholder="password"
                      />
                      <has-error :form="form" field="password"></has-error>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Profile Picture</label>
                    <div class="col-sm-10">
                      <input type="file" @change="updateProfile" name="photo" id="photo" />
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button
                        @click.prevent="updateInfo"
                        type="submit"
                        class="btn btn-primary"
                      >Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
      </div>
    </div>
  </div>
</template>

<script>
import { Form, HasError, AlertError } from "vform";
window.form = Form;
export default {
  name: "Profile",
  data() {
    return {
      form: new Form({
        id: "",
        name: "",
        email: "",
        password: "",
        type: "",
        bio: "",
        photo: "",
      }),
    };
  },
  created() {
    // get method with axios
    this.loadData();
  },
  methods: {
    updateProfile(e) {
      //console.log("uploading");
      let file = e.target.files[0];
      // console.log(file);
      let reader = new FileReader();
      if (file["size"] < 2111775) {
        reader.onloadend = (file) => {
          // console.log("RESULT", reader.result);
          this.form.photo = reader.result;
        };
        reader.readAsDataURL(file);
      } else {
        swal.fire({
          icon: "error",
          title: "Ooopss..",
          text: "Ukuran Foto Anda Terlalu Besar..",
        });
        file = "";
      }
    },

    updateInfo() {
      this.$Progress.start();

      this.form
        .put("api/profile")
        .then(() => {
          this.loadData();
          swal.fire({
            position: "top-end",
            icon: "success",
            title: "Your work has been saved",
            showConfirmButton: false,
            timer: 1500,
          });
          this.file = "";
          this.$Progress.finish();
        })
        .catch(() => {
          swal.fire({
            icon: "error",
            title: "Ooopss..",
            text: "Harus ada isi pada field ini",
          });
          this.$Progress.fail();
        });
    },
    loadData() {
      axios.get("api/profile").then(({ data }) => this.form.fill(data));
    },
    getProfilePhoto() {
      return "img/profile/" + this.form.photo;
    },
  },
};
</script>
<style scoped>
.widget-user-header {
  background-position: center center;
  background-size: cover;
  height: 200px;
}
</style>