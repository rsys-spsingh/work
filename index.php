<?php get_header(); ?>

<main>
    <!-- Banner Section -->
    <section class="banner-section">
        <div class="banner-container">
            <div class="banner-content">
                <span class="banner-icon">🎓</span>
                <span class="banner-text">We are the top admission provider in India. Provided successfully 1 lakh+ admissions</span>
                <span class="banner-badge">Trusted by Students</span>
            </div>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="hero-section">
        <!-- Quote Section -->
        <div class="quote-section">
            <div class="quote-text">
                "Education is the most powerful weapon which you can use to change the world."
            </div>
            <div class="quote-author">- Nelson Mandela</div>
        </div>

        <!-- Contact Form -->
        <div class="form-section">
            <h2 class="form-title">Get Started Today</h2>
            <form id="contact-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                <input type="hidden" name="action" value="contact_form_submission">
                <?php wp_nonce_field('contact_form_nonce', 'contact_form_nonce'); ?>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">First Name *</label>
                        <input type="text" id="first_name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name *</label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="country_code">Country Code *</label>
                        <select id="country_code" name="country_code" required>
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
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" id="phone" name="phone" placeholder="98765 43210" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="course">Select Course *</label>
                    <select id="course" name="course" required>
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
                </div>

                <button type="submit" class="submit-btn">Submit Application</button>
            </form>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="partners-section">
        <h2 class="partners-title">Our Partners</h2>
        <div class="slideshow-container">
            <div class="slides active">
                <div class="partner-logos">
                    <div class="partner-logo">
                        <img src="https://via.placeholder.com/120x80/f8f9fa/666666?text=Partner+1" alt="Partner 1">
                    </div>
                    <div class="partner-logo">
                        <img src="https://via.placeholder.com/120x80/f8f9fa/666666?text=Partner+2" alt="Partner 2">
                    </div>
                    <div class="partner-logo">
                        <img src="https://via.placeholder.com/120x80/f8f9fa/666666?text=Partner+3" alt="Partner 3">
                    </div>
                    <div class="partner-logo">
                        <img src="https://via.placeholder.com/120x80/f8f9fa/666666?text=Partner+4" alt="Partner 4">
                    </div>
                    <div class="partner-logo">
                        <img src="https://via.placeholder.com/120x80/f8f9fa/666666?text=Partner+5" alt="Partner 5">
                    </div>
                </div>
            </div>
            <div class="slides">
                <div class="partner-logos">
                    <div class="partner-logo">
                        <img src="https://via.placeholder.com/120x80/f8f9fa/666666?text=Partner+6" alt="Partner 6">
                    </div>
                    <div class="partner-logo">
                        <img src="https://via.placeholder.com/120x80/f8f9fa/666666?text=Partner+7" alt="Partner 7">
                    </div>
                    <div class="partner-logo">
                        <img src="https://via.placeholder.com/120x80/f8f9fa/666666?text=Partner+8" alt="Partner 8">
                    </div>
                    <div class="partner-logo">
                        <img src="https://via.placeholder.com/120x80/f8f9fa/666666?text=Partner+9" alt="Partner 9">
                    </div>
                    <div class="partner-logo">
                        <img src="https://via.placeholder.com/120x80/f8f9fa/666666?text=Partner+10" alt="Partner 10">
                    </div>
                </div>
            </div>
            <div class="slides">
                <div class="partner-logos">
                    <div class="partner-logo">
                        <img src="https://via.placeholder.com/120x80/f8f9fa/666666?text=Partner+11" alt="Partner 11">
                    </div>
                    <div class="partner-logo">
                        <img src="https://via.placeholder.com/120x80/f8f9fa/666666?text=Partner+12" alt="Partner 12">
                    </div>
                    <div class="partner-logo">
                        <img src="https://via.placeholder.com/120x80/f8f9fa/666666?text=Partner+13" alt="Partner 13">
                    </div>
                    <div class="partner-logo">
                        <img src="https://via.placeholder.com/120x80/f8f9fa/666666?text=Partner+14" alt="Partner 14">
                    </div>
                    <div class="partner-logo">
                        <img src="https://via.placeholder.com/120x80/f8f9fa/666666?text=Partner+15" alt="Partner 15">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="dots-container">
            <span class="dot active" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
        </div>
    </section>

    <!-- Experts Section -->
    <section class="experts-section">
        <h2 class="experts-title">Right Guidance from experts</h2>
        <p class="experts-description">
            Degree Drishti has good experts who are assisting you since 2023 and giving you the right guidance for your successful career ahead.
        </p>
        
        <div class="experts-slideshow-container">
            <div class="expert-slides active">
                <div class="expert-cards">
                    <div class="expert-card">
                        <div class="expert-image">
                            <img src="https://via.placeholder.com/150x150/1e3c72/ffffff?text=DR" alt="Dr. Rajesh Kumar">
                        </div>
                        <div class="expert-info">
                            <h3 class="expert-name">Dr. Rajesh Kumar</h3>
                            <p class="expert-qualification">Ph.D. in Management, MBA from IIM-A</p>
                            <p class="expert-experience">15+ Years Experience</p>
                            <div class="expert-stats">
                                <span class="stat-item">
                                    <span class="stat-number">2,500+</span>
                                    <span class="stat-label">Counselling Sessions</span>
                                </span>
                            </div>
                            <div class="expert-specialization">
                                <span class="specialization-tag">MBA Admissions</span>
                                <span class="specialization-tag">Career Guidance</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="expert-card">
                        <div class="expert-image">
                            <img src="https://via.placeholder.com/150x150/2a5298/ffffff?text=PS" alt="Prof. Priya Sharma">
                        </div>
                        <div class="expert-info">
                            <h3 class="expert-name">Prof. Priya Sharma</h3>
                            <p class="expert-qualification">M.Tech in Computer Science, B.Tech</p>
                            <p class="expert-experience">12+ Years Experience</p>
                            <div class="expert-stats">
                                <span class="stat-item">
                                    <span class="stat-number">1,800+</span>
                                    <span class="stat-label">Counselling Sessions</span>
                                </span>
                            </div>
                            <div class="expert-specialization">
                                <span class="specialization-tag">Tech Programs</span>
                                <span class="specialization-tag">MCA/BCA</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="expert-card">
                        <div class="expert-image">
                            <img src="https://via.placeholder.com/150x150/667eea/ffffff?text=AS" alt="Mr. Amit Singh">
                        </div>
                        <div class="expert-info">
                            <h3 class="expert-name">Mr. Amit Singh</h3>
                            <p class="expert-qualification">CA, MBA Finance</p>
                            <p class="expert-experience">10+ Years Experience</p>
                            <div class="expert-stats">
                                <span class="stat-item">
                                    <span class="stat-number">1,200+</span>
                                    <span class="stat-label">Counselling Sessions</span>
                                </span>
                            </div>
                            <div class="expert-specialization">
                                <span class="specialization-tag">Commerce</span>
                                <span class="specialization-tag">ACCA</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="expert-slides">
                <div class="expert-cards">
                    <div class="expert-card">
                        <div class="expert-image">
                            <img src="https://via.placeholder.com/150x150/764ba2/ffffff?text=ST" alt="Dr. Sneha Tandon">
                        </div>
                        <div class="expert-info">
                            <h3 class="expert-name">Dr. Sneha Tandon</h3>
                            <p class="expert-qualification">Ph.D. in Mass Communication</p>
                            <p class="expert-experience">14+ Years Experience</p>
                            <div class="expert-stats">
                                <span class="stat-item">
                                    <span class="stat-number">2,100+</span>
                                    <span class="stat-label">Counselling Sessions</span>
                                </span>
                            </div>
                            <div class="expert-specialization">
                                <span class="specialization-tag">Journalism</span>
                                <span class="specialization-tag">Media Studies</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="expert-card">
                        <div class="expert-image">
                            <img src="https://via.placeholder.com/150x150/ee5a24/ffffff?text=VG" alt="Mr. Vikash Gupta">
                        </div>
                        <div class="expert-info">
                            <h3 class="expert-name">Mr. Vikash Gupta</h3>
                            <p class="expert-qualification">MSc Data Science, B.Tech IT</p>
                            <p class="expert-experience">8+ Years Experience</p>
                            <div class="expert-stats">
                                <span class="stat-item">
                                    <span class="stat-number">950+</span>
                                    <span class="stat-label">Counselling Sessions</span>
                                </span>
                            </div>
                            <div class="expert-specialization">
                                <span class="specialization-tag">Data Science</span>
                                <span class="specialization-tag">Analytics</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="expert-card">
                        <div class="expert-image">
                            <img src="https://via.placeholder.com/150x150/48dbfb/ffffff?text=NK" alt="Ms. Neha Kapoor">
                        </div>
                        <div class="expert-info">
                            <h3 class="expert-name">Ms. Neha Kapoor</h3>
                            <p class="expert-qualification">MA Public Policy, LLB</p>
                            <p class="expert-experience">11+ Years Experience</p>
                            <div class="expert-stats">
                                <span class="stat-item">
                                    <span class="stat-number">1,600+</span>
                                    <span class="stat-label">Counselling Sessions</span>
                                </span>
                            </div>
                            <div class="expert-specialization">
                                <span class="specialization-tag">Public Policy</span>
                                <span class="specialization-tag">Governance</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="expert-dots-container">
            <span class="expert-dot active" onclick="currentExpertSlide(1)"></span>
            <span class="expert-dot" onclick="currentExpertSlide(2)"></span>
        </div>
    </section>
</main>

<?php get_footer(); ?>