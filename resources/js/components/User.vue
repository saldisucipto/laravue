<template>
  <div class="container pt-5">
    <div class="row justify-content-center">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <div class="card-title pt-3">
              <div class="row">
                <h3 class="pl-2">List User |</h3>
                <a class="pl-2" href="#">
                  <i class="fas fa-plus-circle"></i> Create New User
                </a>
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
  </div>
</template>
<script>
export default {
  name: "User",
};
</script>