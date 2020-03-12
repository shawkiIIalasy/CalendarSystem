<template>
    <span>
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">
            <span class="fa fa-plus"></span>
            Add Event
        </button>

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title">Create Event</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form class="form" @submit.prevent="submit">
                        <div class="modal-body">

                            <div class="form-group">
                                <span class="fa fa-camera-retro"></span>
                                <input type="text" name="title" placeholder="Add Title" v-model="fields.title">
                                <div v-if="errors && errors.title" class="text-danger">{{ errors.title[0] }}</div>
                            </div>
                            <div class="form-group">
                                <span class="fa fa-calendar"></span>
                                <input type="date" name="sdate" v-model="fields.sdate">
                                <input type="date" name="edate" v-model="fields.edate">
                            </div>
                            <div class="form-group">
                                <span class="fa fa-clock"></span>
                                <input type="time" name="stime" v-model="fields.stime">
                                <input type="time" name="etime" v-model="fields.etime">
                            </div>
                            <div class="form-group">
                                <span class="fa fa-users"></span>
                                <select v-model="fields.selected" name="guests[]" multiple>
                                    <option v-for="option in fields.optionsFields" v-bind:value="option">
                                        {{ option.email }}
                                    </option>
                                </select>
                            </div>
                            <div class="form-group p-md-2">
                                <button v-for="user in fields.selected" @click="removeUser(fields.selected.user)" class="btn btn-primary m-1 text-left">
                                    {{user.name}}<br>
                                    {{ user.email }}
                                </button>
                            </div>
                            <div class="form-group">
                                <span class="fa fa-align-justify"></span>
                                <input type="text" name="description" placeholder="Add Description"
                                       v-model="fields.description">
                            </div>
                            <div class="form-group">
                                <label class="form-check-label">Repeat Days</label>
                                <div id='example-3'>
                                    <input type="checkbox" id="1" value="1" v-model="checkedDays">
                                    <label for="1">Sunday</label>
                                    <input type="checkbox" id="2" value="2" v-model="checkedDays">
                                    <label for="2">Monday</label>
                                    <input type="checkbox" id="3" value="3" v-model="checkedDays">
                                    <label for="3">Tuesday</label>
                                    <input type="checkbox" id="4" value="4" v-model="checkedDays">
                                    <label for="4">Wednesday</label>
                                    <input type="checkbox" id="5" value="5" v-model="checkedDays">
                                    <label for="5">Thursday</label>
                                    <input type="checkbox" id="6" value="6" v-model="checkedDays">
                                    <label for="6">Friday</label>
                                    <input type="checkbox" id="7" value="7" v-model="checkedDays">
                                    <label for="7">Saturday</label>
                                    <input type="checkbox" id="0" value="0" v-model="checkedDays">
                                    <label for="0">All Days</label>
                                </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </span>
</template>
<script>
    export default {
        mounted: function () {
            this.getAllUser(); //method1 will execute at pageload
        },
        data() {
            return {
                checkedDays: [],
                fields: {
                    selected:[],
                    optionsFields:[],
                },
                errors: {},
                modalShow: false
            }
        },
        methods: {
            submit() {

                this.errors = {};
                let currentObj = this;
                axios.post('/submit', this.fields).then(response => {
                    $('#myModal').modal('hide');
                    object.f();

                    this.fields = {};
                    currentObj.output = response.data;
                    flash('Post Request Added Created.', 'success');
                }).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            },
            getAllUser() {
                axios.get('/usersClient').then(response => {
                    this.fields.optionsFields = response.data;
                }).catch(error => {
                    console.log('error');
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });

            },
            removeUser(user)
            {
                this.fields.selected.splice(user);
            }
        },
    }
</script>
