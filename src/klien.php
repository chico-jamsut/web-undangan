<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSX Brotherhood - Our Partners</title>
    <link rel="stylesheet" href="../style/output.css">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oswald:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        html {
            scroll-behavior: smooth;
            background-color: #000;
        }
        body {
    font-family: 'Oswald', sans-serif;
    background-color: #111;
    color: white;
  }

    h1, .logo {
    font-family: 'Bebas Neue', sans-serif;
    font-size: 28px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #ff2d2d;
  }
        .partner-header {
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)), url('../public/partners-banner.jpg');
            background-size: cover;
            background-position: center;
            height: 50vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            border-bottom: 3px solid #dc2626;
        }
        h1, .partner-title {
            font-family: 'Russo One', sans-serif;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: #dc2626;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        .partner-card {
            background: linear-gradient(145deg, #1a1a1a, #0d0d0d);
            border: 1px solid #333;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }
        .partner-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(220, 38, 38, 0.3);
            border-color: #dc2626;
        }
        .partner-logo {
            height: 100px;
            width: 100%;
            object-fit: contain;
            padding: 1.5rem;
            transition: transform 0.3s ease;
            filter: grayscale(100%) brightness(0.8);
        }
        .partner-card:hover .partner-logo {
            filter: grayscale(0%) brightness(1);
            transform: scale(1.1);
        }
        .partner-type {
            position: absolute;
            top: 0;
            right: 0;
            background-color: #dc2626;
            color: white;
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            font-weight: bold;
        }
        .section-title {
            position: relative;
            display: inline-block;
            margin-bottom: 3rem;
        }
        .section-title:after {
            content: '';
            position: absolute;
            width: 50%;
            height: 3px;
            background: #dc2626;
            bottom: -10px;
            left: 25%;
        }
    </style>
</head>
<body>

<?php include '../nav.php' ?>

<!-- Partner Header Banner -->
<div class="partner-header">
    <h1 class="text-4xl md:text-5xl mb-4">OUR TRUSTED PARTNERS</h1>
    <p class="text-xl max-w-2xl px-4">The brands that ride with the GSX Brotherhood</p>
</div>

<!-- Partners Section -->
<section id="klien" class="py-20 px-4 md:px-8 lg:px-16">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-4xl text-center section-title">OFFICIAL PARTNERS</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <!-- Partner 1 - Custom Garage -->
            <div class="partner-card rounded-lg">
                <span class="partner-type">PERFORMANCE</span>
                <img src="https://images.unsplash.com/photo-1597852074816-d933c7d2b988?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" 
                     alt="FastRide Custom Garage" 
                     class="partner-logo">
                <div class="p-6 pt-0 text-center">
                    <h3 class="partner-title text-xl mb-2">FASTRIDE CUSTOM</h3>
                    <p class="text-gray-400 text-sm">Official modification partner since 2018</p>
                    <a href="#" class="text-red-500 text-xs mt-3 inline-block hover:underline">
                        VISIT WEBSITE <i class="fas fa-external-link-alt ml-1"></i>
                    </a>
                </div>
            </div>

            <!-- Partner 2 - Suzuki -->
            <div class="partner-card rounded-lg">
                <span class="partner-type">MANUFACTURER</span>
                <img src="../public/suzuki.png" 
                     alt="Suzuki Indonesia" 
                     class="partner-logo bg-white p-2">
                <div class="p-6 pt-0 text-center">
                    <h3 class="partner-title text-xl mb-2">SUZUKI INDONESIA</h3>
                    <p class="text-gray-400 text-sm">Factory support since 2020</p>
                    <a href="https://suzuki.co.id" class="text-red-500 text-xs mt-3 inline-block hover:underline">
                        VISIT WEBSITE <i class="fas fa-external-link-alt ml-1"></i>
                    </a>
                </div>
            </div>

            <!-- Partner 3 - Performance Garage -->
            <div class="partner-card rounded-lg">
                <span class="partner-type">TUNING</span>
                <img src="../public/tdr.png" 
                     alt="TDR Garage" 
                     class="partner-logo">
                <div class="p-6 pt-0 text-center">
                    <h3 class="partner-title text-xl mb-2">TDR GARAGE</h3>
                    <p class="text-gray-400 text-sm">Official performance workshop</p>
                    <a href="https://tdr-racing.com/" class="text-red-500 text-xs mt-3 inline-block hover:underline">
                        VISIT WEBSITE <i class="fas fa-external-link-alt ml-1"></i>
                    </a>
                </div>
            </div>

            <!-- Partner 4 - Fuel Sponsor -->
            <div class="partner-card rounded-lg">
                <span class="partner-type">FUEL</span>
                <img src="../public/enduro.jpeg" 
                     alt="Pertamina Enduro" 
                     class="partner-logo bg-white p-2">
                <div class="p-6 pt-0 text-center">
                    <h3 class="partner-title text-xl mb-2">PERTAMINA ENDURO</h3>
                    <p class="text-gray-400 text-sm">National tour sponsor</p>
                    <a href="https://www.pertamina.com/" class="text-red-500 text-xs mt-3 inline-block hover:underline">
                        VISIT WEBSITE <i class="fas fa-external-link-alt ml-1"></i>
                    </a>
                </div>
            </div>

            <!-- Partner 5 - Apparel -->
            <div class="partner-card rounded-lg">
                <span class="partner-type">APPAREL</span>
                <img src="https://images.unsplash.com/photo-1529374255404-311a2a4f1fd9?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" 
                     alt="RideWear Apparel" 
                     class="partner-logo">
                <div class="p-6 pt-0 text-center">
                    <h3 class="partner-title text-xl mb-2">RIDEWEAR APPAREL</h3>
                    <p class="text-gray-400 text-sm">Official merchandise provider</p>
                    <a href="#" class="text-red-500 text-xs mt-3 inline-block hover:underline">
                        VISIT WEBSITE <i class="fas fa-external-link-alt ml-1"></i>
                    </a>
                </div>
            </div>

            <!-- Partner 6 - MC Club -->
            <div class="partner-card rounded-lg">
                <span class="partner-type">BROTHER CLUB</span>
                <img src="https://images.unsplash.com/photo-1558981806-ec527fa84c39?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=500&q=80" 
                     alt="Brotherhood MC" 
                     class="partner-logo">
                <div class="p-6 pt-0 text-center">
                    <h3 class="partner-title text-xl mb-2">BROTHERHOOD MC</h3>
                    <p class="text-gray-400 text-sm">National motorcycle community</p>
                    <a href="#" class="text-red-500 text-xs mt-3 inline-block hover:underline">
                        VISIT WEBSITE <i class="fas fa-external-link-alt ml-1"></i>
                    </a>
                </div>
            </div>

            <!-- Partner 7 - Helmet -->
            <div class="partner-card rounded-lg">
                <span class="partner-type">SAFETY GEAR</span>
                <img src="../public/arai.jpg" 
                     alt="Arai Helmets" 
                     class="partner-logo">
                <div class="p-6 pt-0 text-center">
                    <h3 class="partner-title text-xl mb-2">ARAI HELMETS</h3>
                    <p class="text-gray-400 text-sm">Premium safety equipment</p>
                    <a href="https://www.araihelmet.eu/" class="text-red-500 text-xs mt-3 inline-block hover:underline">
                        VISIT WEBSITE <i class="fas fa-external-link-alt ml-1"></i>
                    </a>
                </div>
            </div>

            <!-- Partner 8 - Tire -->
            <div class="partner-card rounded-lg">
                <span class="partner-type">TIRE</span>
                <img src="../public/michelin.jpeg" 
                     alt="Michelin Tires" 
                     class="partner-logo bg-white p-2">
                <div class="p-6 pt-0 text-center">
                    <h3 class="partner-title text-xl mb-2">MICHELIN TIRES</h3>
                    <p class="text-gray-400 text-sm">Official tire partner</p>
                    <a href="https://www.michelin.co.id/" class="text-red-500 text-xs mt-3 inline-block hover:underline">
                        VISIT WEBSITE <i class="fas fa-external-link-alt ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<!-- <section class="py-16 bg-black bg-opacity-70 border-y border-gray-800">
    <div class="max-w-4xl mx-auto text-center px-4">
        <h2 class="text-3xl md:text-4xl mb-6">WANT TO BECOME A PARTNER?</h2>
        <p class="text-gray-400 mb-8 text-lg">Join our network of trusted brands and reach the motorcycle community</p>
        <a href="#contact" class="inline-block bg-red-600 hover:bg-red-700 text-white px-10 py-3 text-lg rounded-md font-bold transition-colors">
            CONTACT PARTNERSHIP <i class="fas fa-handshake ml-2"></i>
        </a>
    </div>
</section> -->

<!-- Footer -->
<?php include 'footer.php' ?>


</body>
</html>