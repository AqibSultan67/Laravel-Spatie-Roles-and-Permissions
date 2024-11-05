<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Website Sections</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Custom styles */
        .section {
            padding: 60px 0;
        }

        .awards .fa-trophy,
        .team .fa-users,
        .clients .fa-users,
        .pricing .fa-dollar-sign,
        .testimonials .fa-quote-left,
        .faq .fa-question-circle,
        .blog .fa-blog {
            font-size: 48px;
            margin-bottom: 20px;
            color: #348934;
        }

        .team img {
            border-radius: 50%;
        }

        .testimonial-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
        }

        .footer-links a {
            color: white;
        }

        .footer-links a:hover {
            color: #f8f9fa;
        }

        .footer {
            background-color: #212529;
            color: white;
            padding: 40px 0;
        }
        .pricing-card {
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .pricing-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .pricing-card .card-price {
        font-size: 2rem;
        color: #348934;
    }

    .pricing-card .card-price span {
        font-size: 1rem;
        color: #888;
    }

    .pricing-card ul {
        font-size: 1rem;
        color: #6c757d;
    }

    .pricing-card .btn-outline-primary {
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .pricing-card .btn-outline-primary:hover {
        background-color: #348934;
        color: white;
    }
    .card-img-wrapper {
        overflow: hidden;
    }

    .card-img-top {
        transition: transform 0.3s ease;
    }

    .card-img-wrapper:hover .card-img-top {
        transform: scale(1.1);
    }
    .product-card .card-img-top {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card:hover .card-img-top {
        transform: scale(1.1);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }
    .testimonial-img-wrapper {
        width: 100px;
        height: 100px;
        margin: 0 auto;
        overflow: hidden;
        border: 3px solid #ddd;
        border-radius: 50%;
    }

    .testimonial-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .testimonial-card:hover img {
        transform: scale(1.1);
    }
    .award-card {
        border-radius: 10px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .award-card img {
        max-width: 150px;
        height: auto;
        margin: 0 auto;
    }

    .award-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .awards h2 {
        font-weight: 700;
        color: #333;
    }

    .awards .lead {
        font-size: 1.25rem;
        color: #666;
    }
    .card{
        background-color: #e8e5dd;
    }
    </style>
</head>

<body>

    <!-- Awards Section -->
<section class="awards section text-center bg-light py-5">
    <div class="container">
        <h2 class="mb-5">Our Awards & Achievements</h2>
        <p class="lead mb-4">We are honored to have been recognized for our dedication to excellence and innovation across multiple industries. These awards reflect our commitment to delivering outstanding services to our clients worldwide.</p>

        <div class="row">
            <!-- Award 1 -->
            <div class="col-md-4 mb-4">
                <div class="award-card shadow-sm p-4 bg-white h-100">
                    <img src="https://via.placeholder.com/150x150" class="img-fluid mb-3" alt="Award 1">
                    <h5>Best Industry Leader 2023</h5>
                    <p class="small">Awarded for excellence in innovation and leadership in the tech industry.</p>
                </div>
            </div>

            <!-- Award 2 -->
            <div class="col-md-4 mb-4">
                <div class="award-card shadow-sm p-4 bg-white h-100">
                    <img src="https://via.placeholder.com/150x150" class="img-fluid mb-3" alt="Award 2">
                    <h5>Customer Choice Award</h5>
                    <p class="small">Voted as the top service provider by thousands of satisfied customers.</p>
                </div>
            </div>

            <!-- Award 3 -->
            <div class="col-md-4 mb-4">
                <div class="award-card shadow-sm p-4 bg-white h-100">
                    <img src="https://via.placeholder.com/150x150" class="img-fluid mb-3" alt="Award 3">
                    <h5>Innovation Excellence Award</h5>
                    <p class="small">Recognized for groundbreaking innovation and contributions to the industry.</p>
                </div>
            </div>
        </div>

        <a href="#more-awards" class="btn btn-primary mt-4">View All Awards</a>
    </div>
</section>

    <!-- Team Section -->
    <section class="team section text-center">
        <div class="container">
            <h2>Meet Our Team</h2>
            <i class="fas fa-users"></i>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <img src="https://via.placeholder.com/150" alt="Team Member" class="img-fluid mb-2">
                    <h5>John Doe</h5>
                    <p>CEO</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <img src="https://via.placeholder.com/150" alt="Team Member" class="img-fluid mb-2">
                    <h5>Jane Smith</h5>
                    <p>CTO</p>
                </div>
                <!-- Add more team members here -->
            </div>
        </div>
    </section>

    <!-- Pricing Section with Cards -->
<section class="pricing section bg-light text-center">
    <div class="container">
        <h2>Pricing Plan</h2>
        <div class="row justify-content-center">
            <!-- Basic Plan -->
            <div class="col-md-4 mb-4">
                <div class="card pricing-card shadow-sm h-100">
                    <div class="card-body">
                        <h4 class="card-title">Basic Plan</h4>
                        <h5 class="card-price">$10<span>/month</span></h5>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>10 GB Storage</li>
                            <li>100 Email Accounts</li>
                            <li>24/7 Support</li>
                        </ul>
                        <a href="#" class="btn btn-outline-primary">Choose Plan</a>
                    </div>
                </div>
            </div>

            <!-- Standard Plan -->
            <div class="col-md-4 mb-4">
                <div class="card pricing-card shadow-sm h-100">
                    <div class="card-body">
                        <h4 class="card-title">Standard Plan</h4>
                        <h5 class="card-price">$30<span>/month</span></h5>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>50 GB Storage</li>
                            <li>500 Email Accounts</li>
                            <li>Priority Support</li>
                        </ul>
                        <a href="#" class="btn btn-outline-primary">Choose Plan</a>
                    </div>
                </div>
            </div>

            <!-- Premium Plan -->
            <div class="col-md-4 mb-4">
                <div class="card pricing-card shadow-sm h-100">
                    <div class="card-body">
                        <h4 class="card-title">Premium Plan</h4>
                        <h5 class="card-price">$50<span>/month</span></h5>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Unlimited Storage</li>
                            <li>Unlimited Email Accounts</li>
                            <li>Dedicated Support</li>
                        </ul>
                        <a href="#" class="btn btn-outline-primary">Choose Plan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



    <!-- Testimonials Section -->
<section class="testimonials section bg-light py-5">
    <div class="container">
        <h2 class="text-center mb-5">What Our Clients Say</h2>
        <div class="row">
            <!-- Testimonial 1 -->
            <div class="col-md-4 mb-4">
                <div class="testimonial-card p-4 text-center shadow-sm h-100">
                    <div class="testimonial-img-wrapper mb-3">
                        <img src="https://via.placeholder.com/100x100" class="rounded-circle" alt="Client 1">
                    </div>
                    <i class="fas fa-quote-left fa-lg mb-3"></i>
                    <p>"Amazing service! Highly recommended."</p>
                    <h6>- Client 1</h6>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="col-md-4 mb-4">
                <div class="testimonial-card p-4 text-center shadow-sm h-100">
                    <div class="testimonial-img-wrapper mb-3">
                        <img src="https://via.placeholder.com/100x100" class="rounded-circle" alt="Client 2">
                    </div>
                    <i class="fas fa-quote-left fa-lg mb-3"></i>
                    <p>"Professional and efficient!"</p>
                    <h6>- Client 2</h6>
                </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="col-md-4 mb-4">
                <div class="testimonial-card p-4 text-center shadow-sm h-100">
                    <div class="testimonial-img-wrapper mb-3">
                        <img src="https://via.placeholder.com/100x100" class="rounded-circle" alt="Client 3">
                    </div>
                    <i class="fas fa-quote-left fa-lg mb-3"></i>
                    <p>"Exceptional customer support and great results."</p>
                    <h6>- Client 3</h6>
                </div>
            </div>
        </div>
    </div>
</section>

   <!-- Products Section -->
<section class="products section py-5">
    <div class="container">
        <h2 class="text-center mb-5">Featured Products</h2>
        <div class="row">
            <!-- Product 1 -->
            <div class="col-md-3 mb-4">
                <div class="card product-card shadow-sm h-100">
                    <div class="card-img-wrapper">
                        <img src="https://via.placeholder.com/300x300" class="card-img-top img-fluid" alt="Product 1">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Product 1</h5>
                        <p class="card-text">$25.00</p>
                        <a href="#" class="btn btn-outline-primary">View Product</a>
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="col-md-3 mb-4">
                <div class="card product-card shadow-sm h-100">
                    <div class="card-img-wrapper">
                        <img src="https://via.placeholder.com/300x300" class="card-img-top img-fluid" alt="Product 2">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Product 2</h5>
                        <p class="card-text">$30.00</p>
                        <a href="#" class="btn btn-outline-primary">View Product</a>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="col-md-3 mb-4">
                <div class="card product-card shadow-sm h-100">
                    <div class="card-img-wrapper">
                        <img src="https://via.placeholder.com/300x300" class="card-img-top img-fluid" alt="Product 3">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Product 3</h5>
                        <p class="card-text">$40.00</p>
                        <a href="#" class="btn btn-outline-primary">View Product</a>
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="col-md-3 mb-4">
                <div class="card product-card shadow-sm h-100">
                    <div class="card-img-wrapper">
                        <img src="https://via.placeholder.com/300x300" class="card-img-top img-fluid" alt="Product 4">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Product 4</h5>
                        <p class="card-text">$50.00</p>
                        <a href="#" class="btn btn-outline-primary">View Product</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Blog Section -->
    <section class="news-blogs section py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Latest News & Blogs</h2>
            <div class="row">
                <!-- Blog 1 -->
                <div class="col-md-4 mb-4">
                    <div class="card blog-card shadow-sm h-100">
                        <div class="card-img-wrapper">
                            <img src="https://via.placeholder.com/400x250" class="card-img-top img-fluid" alt="Blog Image 1">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Blog Post 1</h5>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vel sapien et est...</p>
                            <a href="#" class="btn btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>

                <!-- Blog 2 -->
                <div class="col-md-4 mb-4">
                    <div class="card blog-card shadow-sm h-100">
                        <div class="card-img-wrapper">
                            <img src="https://via.placeholder.com/400x250" class="card-img-top img-fluid" alt="Blog Image 2">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Blog Post 2</h5>
                            <p class="card-text">Curabitur vitae magna ut velit dignissim volutpat. Fusce auctor lorem at neque...</p>
                            <a href="#" class="btn btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>

                <!-- Blog 3 -->
                <div class="col-md-4 mb-4">
                    <div class="card blog-card shadow-sm h-100">
                        <div class="card-img-wrapper">
                            <img src="https://via.placeholder.com/400x250" class="card-img-top img-fluid" alt="Blog Image 3">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Blog Post 3</h5>
                            <p class="card-text">Sed suscipit sapien nec nulla tristique, a tincidunt metus aliquet. Pellentesque...</p>
                            <a href="#" class="btn btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq section text-center">
        <div class="container">
            <h2>Asked Questions</h2>
            <i class="fas fa-question-circle"></i>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">
                            What services do you offer?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            We offer a wide range of services from web development to digital marketing.
                        </div>
                    </div>
                </div>
                <!-- Add more FAQ items here -->
            </div>
        </div>
    </section>

    <!-- Before Footer Section -->
    <section class="before-footer section text-center bg-light">
        <div class="container">
            <h2>Ready to Get Started?</h2>
            <p>Contact us today to learn more about our services.</p>
            <a href="#contact" class="btn btn-primary">Contact Us</a>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4 footer-links">
                    <h4>Important Links</h4>
                    <a href="#">Privacy Policy</a><br>
                    <a href="#">Terms & Conditions</a><br>
                    <a href="#">Support</a>
                </div>
                <div class="col-md-4">
                    <h4>Follow Us</h4>
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
                <div class="col-md-4">
                    <h4>Contact Us</h4>
                    <p>Email: info@company.com</p>
                    <p>Phone: +123 456 789</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
