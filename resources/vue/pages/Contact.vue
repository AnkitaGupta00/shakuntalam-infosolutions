<template>
    <div>
        <main id="main" class="mt-16">
        <section id="contact" class="contact">
            <div class="container" >
                <div class="section-title">
                    <h2>Contact</h2>
                    <h4>Your messages must provide sufficient knowledge.</h4>
                    <p>Simply fill out the form to get in touch with our experts. We aim to respond within 1 business day..</p>
                </div>
                <div class="row">
                    <div class="col-lg-5 d-flex align-items-stretch">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Location:</h4>
                                <p>Dadra road, After Railway Crossing<br>
                                    Near - Ashish Gas Agency, Musafirkhana,<br>
                                    Amethi - 227813</p>
                            </div>
                            <div class="email">
                                <i class="bi bi-envelope"></i>
                                <h4>Email:</h4>
                                <p>info@shakuntalaminfosolutions.com</p>
                            </div>

                            <div class="phone">
                                <i class="bi bi-phone"></i>
                                <h4>Call:</h4>
                                <p>+91 7310004002,+91 8957918830</p>
                            </div>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3574.2224252074852!2d81.79533531503377!3d26.38400078335817!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4338e2621c133505%3A0xc8be8db9f5e8d920!2sShakuntalam%20Infosolutions!5e0!3m2!1sen!2sin!4v1669455144525!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                        <form class="php-email-form">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Your Name</label>
                                    <input type="text" name="name" id="name" autocomplete="off" class="form-control " v-model="form.name">
                                    <span class="text-red-700 mb-30" v-if="formErrors.name" v-text="formErrors.name"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email-address">Email address</label>
                                    <input type="email" name="email-address" id="email-address" autocomplete="off" class="form-control " v-model="form.email">
                                    <span class="text-red-700 mb-30" v-if="formErrors.email" v-text="formErrors.email"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="subject">Subject</label>
                                <input type="text" name="city" id="subject" autocomplete="off" class="form-control " v-model="form.subject">
                                <span class="text-red-700 mb-30" v-if="formErrors.subject" v-text="formErrors.subject"/>
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea v-model="form.message" class="form-control" name="message" id="message" rows="10" ></textarea>
                                <span class="text-red-700 mb-30" v-if="formErrors.message" v-text="formErrors.message"/>
                            </div>
                            <div class="col-12">
                                <button type="button" class="btn flex justify-center confer-btn my-4 bg-blue-500 w-full rounded-md" @click="onSubmit">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        </main>
    </div>
</template>

<script>
    export default {
        name: "Contact",
        data(){
            return{
                form:{
                    name: null,
                    email:null,
                    subject:null,
                    message:null,
                },
                formErrors:{
                    name: null,
                    email:null,
                    subject:null,
                    message:null,
                }
            }
        },

        methods:{
            location(){
                window.open(
                    "https://www.google.com/maps/place/Shakuntalam+Infosolutions/@26.3840008,81.797524,15z/data=!4m5!3m4!1s0x0:0xc8be8db9f5e8d920!8m2!3d26.3840008!4d81.797524" + urlSuffix,
                    "_blank"
                );
            },
            async onSubmit(){
                try {
                    console.log( this.$root.$toast);
                    let {data} = await axios.post(`/api/contact`, this.form);
                    this.$toast(data.message);
                } catch ({response}) {
                    this.formErrors = {};
                    if (response.data.errors) {
                        for (const [key, value] of Object.entries(response.data.errors)) {
                            this.formErrors[key] = value[0];
                        }
                    }
                }
            },
        }
    }
</script>

<style scoped>

</style>
