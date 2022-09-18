<template>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">كل المنشورات</h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link to="/">الرئيسيه</router-link>
                </li>
                <li class="breadcrumb-item"><a href="#">Page Layouts</a>
                </li>
                <li class="breadcrumb-item active">Fixed Layout
                </li>
              </ol>
            </div>
          </div>
        </div>
        <div class="content-header-right col-md-6 col-12">
          <div class="dropdown float-md-right">
            <button type="button" class="btn btn-info btn-min-width box-shadow-4 mr-1 mb-1" data-toggle="modal"
              data-target="#zoomIn" @click="newPost">منشور جديد</button>

              <router-link to="/" class="btn btn-success btn-min-width box-shadow-4 mr-1 mb-1">عرض المنشورات</router-link>

            <div class="dropdown-menu" aria-labelledby="dropdownBreadcrumbButton"><a class="dropdown-item" href="#"><i class="la la-calendar-check-o"></i> Calender</a>
              <a class="dropdown-item" href="#"><i class="la la-cart-plus"></i> Cart</a>
              <a class="dropdown-item" href="#"><i class="la la-life-ring"></i> Support</a>
              <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="la la-cog"></i> Settings</a>
            </div>
          </div>
        </div>
      </div>
      <div class="content-body">
        <!-- Description -->
        <section id="description" class="card">
          <div class="card-header">
                <h4 class="card-title">المنشورات</h4>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                  <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                  </ul>
                </div>
              </div>
              <div class="card-content collapse show">
                <div class="card-body card-dashboard ">
                </div>
                <div class="table-responsive">
                  <table class="table mb-0">
                    <thead class="bg-success white">
                      <tr>
                        <th>ID</th>
                        <th>العنوان</th>
                        <th>الوصف</th>
                        <th>العمليات</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="post in posts" :key="post.id">
                        <td>{{post.id}}</td>
                        <td>{{post.title}}</td>
                        <td>{{post.body}}</td>
                        <td>
                          <button type="button" class="btn btn-warning btn-min-width box-shadow-4 mr-1 mb-1 btn-sm" data-toggle="modal"
                          data-target="#zoomIn" @click="editPost(post)">تعديل</button>

                          <button type="button" class="btn btn-danger btn-min-width box-shadow-4 mr-1 mb-1 btn-sm" @click="deletePost(post.id)">حذف</button>

                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
        </section>
        <!--/ Description -->
      </div>
    </div>
  </div>

  <!-- Add new post -->
  <div class="modal animated zoomIn float-right" id="zoomIn" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel69" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel69">Basic Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <label for="lable">العنوان</label>
                  <input type="text" :class="['form-control',errors.title?'is-invalid':'']" id="basicInput" v-model="post.title">
                    <p class="text-left">
                      <small class="danger text-muted" v-if="errors.title">{{errors.title[0]}}</small>
                    </p>
              </div>
              <div class="col-md-12">
                <label for="lable">الوصف</label>
                <textarea :class="['form-control info',errors.body?'is-invalid':'']" id="tareaColor1" rows="3" v-model="post.body">Textarea font Color</textarea>
                  <p class="text-left">
                    <small class="danger text-muted" v-if="errors.body">{{errors.body[0]}}</small>
                  </p>
              </div>
            </div>
            <div class="modal-footer text-right">
          <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">إغلاق</button>

          <button v-if="edit" type="button" class="btn btn-outline-primary" @click="updatPost">تعديل</button>

          <button v-else type="button" class="btn btn-outline-primary" @click="createPost">حفظ</button>

        </div>
        </div>      
      </div>
    </div>
   </div>
</template>

<script>
export default {

  created() {
    this.getPost();
   },

   data(){
    return{
      post:{
        title:'',
        body:'',
        id:'',
      },

      posts:{},
      edit:false,
      errors:[],
   }
   },

   methods: {
    createPost(){
      axios.post('api/createPost',this.post).then(res=>{
        if(res.data.status == 'error'){
          this.errors = res.data.errors;
        }else if(res.data.status == 'success'){
          this.posts.unshift(res.data.data);
          this.errors=[];
          this.post={
            id:'',
            title:'',
            body:'',
          };
        }
      }).catch(error=>{console.log(error)});
    },

    getPost(){
      axios.get('api/getPost').then(res=>{
        this.posts = res.data.data;

      }).catch(error=>{console.log(error)});
    },

    editPost(post){
        this.post = post;
        this.edit = true;
    },

    newPost(){
    this.edit = false;
    },

    updatPost(){
      axios.put('api/updatePost/'+this.post.id,this.post).then(res=>{
        if(res.data.status == 'error'){
          this.errors = res.data.errors;
        }else if(res.data.status == 'success'){

          this.errors=[];
          this.post={
            id:'',
            title:'',
            body:'',
          };
        }
      }).catch(error=>{console.log(error)});
    },

    deletePost(id){
    axios.delete('api/deletePost/'+id).then(res=>{
    this.getPost();
    }).catch(error=>{console.log(error)});
    },

   }
}
</script>