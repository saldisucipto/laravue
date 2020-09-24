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
            <h3 class="widget-user-username">Alexander Pierce</h3>
            <h5 class="widget-user-desc">Founder &amp; CEO</h5>
          </div>
          <div class="widget-user-image">
            <img class="img-circle elevation-2" src="#" alt="User Avatar" />
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
                <a class="nav-link" href="#activity" data-toggle="tab"
                  >Activity</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#settings" data-toggle="tab"
                  >Settings</a
                >
              </li>
            </ul>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane active" id="settings">
                <form class="form-horizontal">
                  <div class="form-group row">
                    <label for="inputName" class="col-sm-2 col-form-label"
                      >Name</label
                    >
                    <div class="col-sm-10">
                      <input
                        type="email"
                        class="form-control"
                        id="inputName"
                        placeholder="Name"
                        v-model="form.name"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail" class="col-sm-2 col-form-label"
                      >Email</label
                    >
                    <div class="col-sm-10">
                      <input
                        type="email"
                        v-model="form.email"
                        class="form-control"
                        id="inputEmail"
                        placeholder="Email"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputExperience" class="col-sm-2 col-form-label"
                      >Bio</label
                    >
                    <div class="col-sm-10">
                      <textarea
                        class="form-control"
                        v-model="form.bio"
                        id="inputExperience"
                        placeholder="Experience"
                      ></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputSkills" class="col-sm-2 col-form-label"
                      >User Type</label
                    >
                    <div class="col-sm-10">
                      <input
                        readonly
                        v-model="form.type"
                        type="text"
                        class="form-control"
                        id="inputSkills"
                        placeholder="Skills"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label"
                      >User Type</label
                    >
                    <div class="col-sm-10">
                      <input
                        v-model="form.password"
                        type="password"
                        class="form-control"
                        id="password"
                        placeholder="password"
                      />
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" /> I agree to the
                          <a href="#">terms and conditions</a>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">
                        Submit
                      </button>
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
        data: "",
      }),
    };
  },
  created() {
    // get method with axios
    axios.get("api/profile").then(({ data }) => this.form.fill(data));
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