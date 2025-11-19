<?php
/*
Template Name: Contact Us Page
*/

get_header(); ?>

<main class="contact-page">
    <!-- Page Header -->
    <section class="contact-header">
        <div class="contact-header-container">
            <div class="contact-hero">
                <h1 class="contact-title">Contact Us</h1>
                <p class="contact-subtitle">Get in touch with our admission experts for personalized guidance</p>
                <div class="contact-breadcrumb">
                    <a href="<?php echo home_url(); ?>">Home</a> > <span>Contact Us</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="contact-content">
        <div class="contact-container">
            <div class="contact-grid">
                <!-- Contact Information -->
                <div class="contact-info">
                    <h2>Get In Touch</h2>
                    <p class="contact-description">
                        Ready to take the next step in your education journey? Our expert counselors are here to help you choose the right program and guide you through the admission process.
                    </p>

                    <div class="contact-details">
                        <div class="contact-item">
                            <div class="contact-icon">📞</div>
                            <div class="contact-text">
                                <h3>Phone</h3>
                                <p><a href="tel:+919876543210">+91 98765 43210</a></p>
                                <p><a href="tel:+911234567890">+91 12345 67890</a></p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">📧</div>
                            <div class="contact-text">
                                <h3>Email</h3>
                                <p><a href="mailto:info@degreedrishti.com">info@degreedrishti.com</a></p>
                                <p><a href="mailto:admissions@degreedrishti.com">admissions@degreedrishti.com</a></p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">📍</div>
                            <div class="contact-text">
                                <h3>Office Address</h3>
                                <p>C Block, Sector 2<br>Noida, Uttar Pradesh 201301<br>India</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">🕒</div>
                            <div class="contact-text">
                                <h3>Office Hours</h3>
                                <p>Monday - Saturday: 9:00 AM - 7:00 PM<br>Sunday: 10:00 AM - 5:00 PM</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media Links -->
                    <div class="social-links">
                        <h3>Follow Us</h3>
                        <div class="social-icons">
                            <a href="#" class="social-icon facebook" title="Facebook">📘</a>
                            <a href="#" class="social-icon twitter" title="Twitter">🐦</a>
                            <a href="#" class="social-icon linkedin" title="LinkedIn">💼</a>
                            <a href="#" class="social-icon instagram" title="Instagram">📷</a>
                            <a href="#" class="social-icon youtube" title="YouTube">📺</a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-form-section">
                    <div class="form-header">
                        <h2>Send us a Message</h2>
                        <p>Fill out the form below and we'll get back to you within 24 hours.</p>
                    </div>

                    <form id="contact-page-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="contact-form">
                        <input type="hidden" name="action" value="contact_page_form_submission">
                        <?php wp_nonce_field('contact_page_form_nonce', 'contact_page_form_nonce'); ?>
                        
                        <!-- Personal Information -->
                        <div class="form-section">
                            <h3 class="form-section-title">Personal Information</h3>
                            
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="contact_first_name">First Name *</label>
                                    <input type="text" id="contact_first_name" name="contact_first_name" required>
                                    <span class="field-icon">👤</span>
                                </div>
                                <div class="form-group">
                                    <label for="contact_last_name">Last Name *</label>
                                    <input type="text" id="contact_last_name" name="contact_last_name" required>
                                    <span class="field-icon">👤</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="contact_email">Email Address *</label>
                                <input type="email" id="contact_email" name="contact_email" required>
                                <span class="field-icon">📧</span>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="contact_country_code">Country Code *</label>
                                    <select id="contact_country_code" name="contact_country_code" required>
                                        <option value="">Select Country</option>
                                        <option value="+91">🇮🇳 India (+91)</option>
                                        <option value="+1">🇺🇸 USA (+1)</option>
                                        <option value="+1">🇨🇦 Canada (+1)</option>
                                        <option value="+44">🇬🇧 UK (+44)</option>
                                        <option value="+61">🇦🇺 Australia (+61)</option>
                                        <option value="+49">🇩🇪 Germany (+49)</option>
                                        <option value="+33">🇫🇷 France (+33)</option>
                                        <option value="+81">🇯🇵 Japan (+81)</option>
                                        <option value="+82">🇰🇷 South Korea (+82)</option>
                                        <option value="+86">🇨🇳 China (+86)</option>
                                        <option value="+971">🇦🇪 UAE (+971)</option>
                                        <option value="+966">🇸🇦 Saudi Arabia (+966)</option>
                                        <option value="+65">🇸🇬 Singapore (+65)</option>
                                        <option value="+60">🇲🇾 Malaysia (+60)</option>
                                        <option value="+66">🇹🇭 Thailand (+66)</option>
                                        <option value="+62">🇮🇩 Indonesia (+62)</option>
                                        <option value="+63">🇵🇭 Philippines (+63)</option>
                                        <option value="+84">🇻🇳 Vietnam (+84)</option>
                                        <option value="+880">🇧🇩 Bangladesh (+880)</option>
                                        <option value="+94">🇱🇰 Sri Lanka (+94)</option>
                                        <option value="+977">🇳🇵 Nepal (+977)</option>
                                    </select>
                                    <span class="field-icon">🌍</span>
                                </div>
                                <div class="form-group">
                                    <label for="contact_phone">Phone Number *</label>
                                    <input type="tel" id="contact_phone" name="contact_phone" placeholder="98765 43210" required>
                                    <span class="field-icon">📱</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="contact_city">City</label>
                                <input type="text" id="contact_city" name="contact_city" placeholder="Your current city">
                                <span class="field-icon">🏙️</span>
                            </div>
                        </div>

                        <!-- Academic Information -->
                        <div class="form-section">
                            <h3 class="form-section-title">Academic Interest</h3>
                            
                            <div class="form-group">
                                <label for="contact_course">Course of Interest *</label>
                                <select id="contact_course" name="contact_course" required>
                                    <option value="">Choose a course...</option>
                                    <optgroup label="Master's Programs">
                                        <option value="MBA">MBA</option>
                                        <option value="MBA-Dual">MBA (Dual Specification)</option>
                                        <option value="MBA-WX">MBA (WX)</option>
                                        <option value="Executive-MBA">Executive MBA (1 year)</option>
                                        <option value="MCA">MCA</option>
                                        <option value="MCom">MCom</option>
                                        <option value="MSc-Data-Science">MSc (Data Science)</option>
                                        <option value="MA-Journalism">MA (Journalism & Mass Communication)</option>
                                        <option value="MA-Public-Policy">MA (Public Policy & Governance)</option>
                                    </optgroup>
                                    <optgroup label="Bachelor's Programs">
                                        <option value="BBA">BBA</option>
                                        <option value="BCA">BCA</option>
                                        <option value="BCom">BCom</option>
                                        <option value="BA">BA</option>
                                    </optgroup>
                                    <optgroup label="Integrated Programs">
                                        <option value="BCA-MCA">BCA + MCA</option>
                                        <option value="BBA-MBA">BBA + MBA</option>
                                        <option value="BCom-MBA">B.Com + MBA</option>
                                        <option value="BCom-ACCA">B.Com + ACCA</option>
                                    </optgroup>
                                    <optgroup label="Certification & Diploma">
                                        <option value="Cert-3Months">Certification Diploma (3 Months)</option>
                                        <option value="Cert-6Months">Certification Diploma (6 Months)</option>
                                        <option value="Diploma-1Year">Diploma (1 Year)</option>
                                    </optgroup>
                                </select>
                                <span class="field-icon">🎓</span>
                            </div>

                            <div class="form-group">
                                <label for="contact_education">Current Education Level</label>
                                <select id="contact_education" name="contact_education">
                                    <option value="">Select your current level</option>
                                    <option value="12th-completed">12th Grade Completed</option>
                                    <option value="12th-appearing">12th Grade Appearing</option>
                                    <option value="graduation-completed">Graduation Completed</option>
                                    <option value="graduation-final-year">Graduation Final Year</option>
                                    <option value="post-graduation">Post Graduation</option>
                                    <option value="working-professional">Working Professional</option>
                                </select>
                                <span class="field-icon">📚</span>
                            </div>

                            <div class="form-group">
                                <label for="contact_preferred_mode">Preferred Mode of Study</label>
                                <select id="contact_preferred_mode" name="contact_preferred_mode">
                                    <option value="">Select preferred mode</option>
                                    <option value="online">Online</option>
                                    <option value="distance">Distance Learning</option>
                                    <option value="regular">Regular/Campus</option>
                                    <option value="weekend">Weekend Classes</option>
                                    <option value="flexible">Flexible Schedule</option>
                                </select>
                                <span class="field-icon">💻</span>
                            </div>
                        </div>

                        <!-- Message Section -->
                        <div class="form-section">
                            <h3 class="form-section-title">Your Message</h3>
                            
                            <div class="form-group">
                                <label for="contact_subject">Subject *</label>
                                <select id="contact_subject" name="contact_subject" required>
                                    <option value="">Select a subject</option>
                                    <option value="course-inquiry">Course Inquiry</option>
                                    <option value="admission-process">Admission Process</option>
                                    <option value="fees-scholarship">Fees & Scholarship</option>
                                    <option value="eligibility">Eligibility Criteria</option>
                                    <option value="career-counseling">Career Counseling</option>
                                    <option value="placement-assistance">Placement Assistance</option>
                                    <option value="technical-support">Technical Support</option>
                                    <option value="other">Other</option>
                                </select>
                                <span class="field-icon">📋</span>
                            </div>

                            <div class="form-group">
                                <label for="contact_message">Message *</label>
                                <textarea id="contact_message" name="contact_message" rows="5" placeholder="Please describe your query in detail..." required></textarea>
                                <span class="field-icon textarea-icon">✍️</span>
                            </div>

                            <div class="form-group checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" id="contact_updates" name="contact_updates" value="yes">
                                    <span class="checkbox-custom"></span>
                                    I would like to receive updates about new courses and admission opportunities
                                </label>
                            </div>

                            <div class="form-group checkbox-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" id="contact_whatsapp" name="contact_whatsapp" value="yes">
                                    <span class="checkbox-custom"></span>
                                    I consent to receive communications via WhatsApp
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-submit">
                            <button type="submit" class="submit-btn">
                                <span class="btn-text">Send Message</span>
                                <span class="btn-icon">📤</span>
                            </button>
                            <p class="form-note">* Required fields</p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="contact-faq">
        <div class="contact-container">
            <h2>Frequently Asked Questions</h2>
            <div class="faq-grid">
                <div class="faq-item">
                    <h3>How long does the admission process take?</h3>
                    <p>Typically, the admission process takes 7-15 business days from the submission of complete documents.</p>
                </div>
                <div class="faq-item">
                    <h3>What documents are required for admission?</h3>
                    <p>You'll need educational certificates, ID proof, passport-size photographs, and specific course-related documents.</p>
                </div>
                <div class="faq-item">
                    <h3>Do you provide placement assistance?</h3>
                    <p>Yes, we have a dedicated placement cell that helps students with job opportunities and career guidance.</p>
                </div>
                <div class="faq-item">
                    <h3>Are scholarships available?</h3>
                    <p>We offer merit-based scholarships and financial assistance programs for eligible students.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section (Optional) -->
    <section class="contact-map">
        <div class="contact-container">
            <h2>Find Us</h2>
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.2339084725835!2d77.3910556!3d28.6138954!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce5456000000%3A0x0!2sSector%202%2C%20Noida%2C%20Uttar%20Pradesh!5e0!3m2!1sen!2sin!4v1234567890123!5m2!1sen!2sin"
                    width="100%" 
                    height="400" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Degree Drishti Office Location">
                </iframe>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>