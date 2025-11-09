<!DOCTYPE html>
<html lang="en">
<?= view('components/head', ['title' => '🔥 Edo Ember Gallery']) ?>

<body class="bg-[var(--accent)] text-[var(--neutral)] font-sans">
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 1s ease, transform 1s ease;
        }

        .reveal-on-scroll.appear {
            opacity: 1;
            transform: translateY(0);
        }

        .parallax {
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
        }
    </style>
    <?= view('components/header'); ?>
    <section class="relative bg-cover bg-center bg-no-repeat px-10 py-24 md:py-32 animate-fadeInUp"
        style="background-image: url('https://i.pinimg.com/1200x/98/43/3b/98433b87e6ce7de76f830f77821cc348.jpg');">
        <div class="absolute inset-0 bg-black/75"></div>
        <div class="relative z-10 max-w-3xl mx-auto text-center text-[var(--neutral)]">
            <p class="italic text-[var(--secondary)]/80">Welcome to Edo Ember Gallery</p>
            <h2 class="text-4xl md:text-5xl font-bold mt-3 leading-tight">
                WHERE <span class="text-[var(--primary)]">TRADITION</span> MEETS
                <span class="text-[var(--secondary)]">DIGITAL</span>
            </h2>
            <p class="text-[var(--neutral)]/80 mt-6 leading-relaxed">
                Edo Ember Gallery brings together timeless brushwork and modern pixels —
                a celebration of the art that burns bright across generations.
            </p><br>
            <?= view('components/buttons/button_border', ['label' => 'Explore Collection', 'href' => '#']); ?>
        </div>
    </section>

    <section class="reveal-on-scroll bg-[#1b1b1b] py-24 px-6 md:px-10 border-t border-[var(--secondary)]/20">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h3 class="text-3xl font-bold text-[var(--neutral)] mb-6">
                    About <span class="text-[var(--secondary)]">Us</span>
                </h3>
                <p class="text-[var(--neutral)]/80 leading-relaxed mb-6">
                    At Edo Ember Gallery, we honor the spirit of creativity that bridges the past and present.
                    Our mission is to showcase a blend of traditional art and contemporary digital expression —
                    celebrating artists who dare to preserve history while kindling new perspectives.
                </p>
                <p class="text-[var(--neutral)]/70 italic mb-8">
                    From curated exhibitions to collectible artbooks, we invite you to experience art that burns
                    with both heritage and innovation.
                </p>
                <?= view('components/buttons/button_border', ['label' => 'Learn More', 'href' => '#']); ?>
            </div>
            <div class="overflow-hidden rounded-xl shadow-lg">
                <img src="https://i.pinimg.com/1200x/59/0a/16/590a1634883ca60ceb1dc223aad4b32d.jpg"
                    alt="About Edo Ember Gallery"
                    class="w-full h-full object-cover hover:scale-105 transition duration-500">
            </div>
        </div>
    </section>

    <section class="reveal-on-scroll bg-[#1b1b1b] py-24 px-6 md:px-10">
        <h3 class="text-3xl font-bold text-center text-[var(--neutral)] mb-14">Artist Spotlight</h3>
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center">
            <div class="overflow-hidden rounded-xl shadow-lg max-w-sm mx-auto">
                <img src="https://preview.redd.it/j9v4a4aogkad1.jpg?width=640&crop=smart&auto=webp&s=98f1290e8926afba2d6f7b323de7826ee2bbcba5"
                    alt="Kei Urana"
                    class="w-full h-auto object-cover hover:scale-105 transition duration-500">
            </div>

            <div>
                <h4 class="text-2xl font-semibold text-[var(--neutral)] mb-4">Kei Urana</h4>
                <p class="text-[var(--neutral)]/80 leading-relaxed mb-4">
                    Kei Urana, creator of <em>Gachiakuta</em>, is known for blending gritty urban energy with dynamic,
                    expressive art that explores human nature and survival in a chaotic world. His work balances
                    realism and stylization — bold linework, raw emotion, and a fearless sense of motion.
                </p>
                <?= view('components/buttons/button_border', ['label' => 'Discover More', 'href' => '#']); ?>
            </div>
        </div>
    </section>

    <section class="bg-[var(--accent)] py-24 px-6 md:px-10 animate-fadeInUp">
        <h3 class="text-3xl font-bold text-center text-[var(--neutral)] mb-14">
            Featured <span class="text-[var(--secondary)]">Artworks</span>
        </h3>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-12 max-w-6xl mx-auto">
            <?php
            $artworks = [
                ["img" => "https://i.pinimg.com/736x/ac/8c/79/ac8c790b5b99c2d8ae52bd4f87f4062e.jpg", "title" => "727", "artist" => "Takashi Murakami"],
                ["img" => "https://i.pinimg.com/736x/0b/f7/31/0bf73170624ab7a124adef98ebf4461d.jpg", "title" => "Lady Murasaki Writing at Her Desk", "artist" => "Tosa Mitsuoki"],
                ["img" => "https://i.pinimg.com/1200x/dd/36/39/dd3639c5b1a79caf949a5b641705a8f2.jpg", "title" => "Dots Obsession", "artist" => "Yayoi Kusama"]
            ];
            foreach ($artworks as $art) : ?>
                <div class="bg-[#1b1b1b] rounded-xl overflow-hidden shadow-lg transform hover:scale-[1.03] transition duration-300">
                    <div class="aspect-[4/5] overflow-hidden">
                        <img src="<?= $art['img'] ?>" alt="<?= $art['title'] ?>"
                            class="w-full h-full object-cover hover:opacity-90 transition">
                    </div>
                    <div class="p-6 text-center">
                        <h4 class="text-[var(--neutral)] text-xl font-semibold mb-1">“<?= $art['title'] ?>”</h4>
                        <p class="text-[var(--neutral)]/70 text-sm italic"><?= $art['artist'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="parallax relative h-96 md:h-[600px] flex items-center justify-center px-10"
        style="background-image: url('https://i.pinimg.com/1200x/86/76/a9/8676a983feae8f85a7d0b816bbc3d09d.jpg');">
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="relative z-10 text-center text-[var(--neutral)]">
            <h3 class="text-4xl md:text-5xl font-bold mb-4">Virtual Gallery Tour</h3>
            <p class="text-[var(--neutral)]/80 max-w-2xl mx-auto">
                Explore our curated spaces from the comfort of your screen — feel the ambiance and immerse yourself in the art.
            </p><br>
            <?= view('components/buttons/button_secondary', ['label' => 'Start Tour', 'href' => '#']); ?>
        </div>
    </section>

    <section class="bg-[var(--accent)] py-24 px-6 md:px-10 border-t border-[var(--secondary)]/20 animate-fadeInUp">
        <h3 class="text-3xl font-bold text-center text-[var(--neutral)] mb-14">
            Upcoming <span class="text-[var(--secondary)]">Exhibits</span>
        </h3>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-10 max-w-6xl mx-auto">
            <?php
            $exhibits = [
                [
                    "img" => "https://i.pinimg.com/736x/34/49/0b/34490b0b1df8fc0405f0ecb603a4879e.jpg",
                    "title" => "Ember Reborn",
                    "desc" => "A showcase of digital reinterpretations of classical Asian art forms."
                ],
                [
                    "img" => "https://i.pinimg.com/1200x/79/88/e1/7988e14a93c7b35b1c2c846107543811.jpg",
                    "title" => "Canvas of Tomorrow",
                    "desc" => "Exploring how modern tools shape the new wave of Asian artists."
                ],
                [
                    "img" => "https://i.pinimg.com/736x/0e/72/cc/0e72cc13494e3db4c466ebb5a88d7a28.jpg",
                    "title" => "Light & Line",
                    "desc" => "An interactive digital exhibit combining animation and calligraphy."
                ]
            ];
            foreach ($exhibits as $event) : ?>
                <div class="bg-[#1b1b1b] rounded-lg overflow-hidden shadow-lg hover:scale-[1.03] transition duration-300">
                    <div class="w-full h-64 overflow-hidden">
                        <img src="<?= $event['img'] ?>" alt="<?= $event['title'] ?>"
                            class="w-full h-full object-cover transition duration-500 hover:scale-110">
                    </div>
                    <div class="p-6">
                        <h4 class="text-[var(--neutral)] text-xl font-semibold mb-2"><?= $event['title'] ?></h4>
                        <p class="text-[var(--neutral)]/70 text-sm mb-4"><?= $event['desc'] ?></p>
                        <a href="#" class="text-[var(--primary)] font-semibold hover:underline">Learn More →</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="reveal-on-scroll bg-[var(--accent)] py-24 px-6 md:px-10">
        <h3 class="text-3xl font-bold text-center text-[var(--neutral)] mb-14">Curator’s Picks on Artbooks</h3>
        <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-8 max-w-6xl mx-auto">
            <?php
            $picks = [
                ["img" => "https://m.media-amazon.com/images/I/81NxXiPzQ1L._AC_UF1000,1000_QL80_.jpg", "title" => "Symbols of Japan by Merrily Baird"],
                ["img" => "https://japanese-creative-books.com/wp-content/uploads/2025/07/MERCURY-Entei-Ryu-Sculptural-Works-757x1024.jpg.webp", "title" => "MERCURY by Entei Ryu"],
                ["img" => "https://japanresell.fr/cdn/shop/files/my-hero-academia-ultra-artworks-893922.jpg?v=1745328958&width=1024", "title" => "My Hero Academia Ultra Artworks by Kohei Horikoshi"],
                ["img" => "https://japanresell.fr/cdn/shop/products/art-book-officiel-the-artwork-of-berserk-berserk-exhibition-220146.jpg?v=1678786386&width=1024", "title" => "The Artwork of Berserk by Miura Kento"]
            ];
            foreach ($picks as $pick) : ?>
                <div class="bg-[#1b1b1b] rounded-xl overflow-hidden shadow-lg transform hover:scale-[1.03] transition duration-300">
                    <div class="aspect-[4/5] overflow-hidden">
                        <img src="<?= $pick['img'] ?>" alt="<?= $pick['title'] ?>" class="w-full h-full object-cover hover:opacity-90 transition">
                    </div>
                    <div class="p-4 text-center">
                        <h4 class="text-[var(--neutral)] font-semibold"><?= $pick['title'] ?></h4>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?= view('components/cta'); ?>

    <button id="scrollTopBtn" class="hidden fixed bottom-8 right-8 bg-[var(--secondary)] text-[var(--accent)] px-4 py-2 rounded-full shadow-md hover:bg-[var(--primary)] transition">
        ↑ Top
    </button>

    <?= view('components/footer'); ?>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const observers = document.querySelectorAll(".reveal-on-scroll");
            const options = {
                threshold: 0.1,
                rootMargin: "0px 0px -100px 0px"
            };
            const observer = new IntersectionObserver((entries, obs) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("appear");
                        obs.unobserve(entry.target);
                    }
                });
            }, options);
            observers.forEach(el => observer.observe(el));
        });

        window.addEventListener("scroll", () => {
            const hero = document.querySelector("section[style*='background-image']");
            let offset = window.pageYOffset;
            hero.style.backgroundPositionY = offset * 0.4 + "px";
        });

        const scrollBtn = document.getElementById("scrollTopBtn");
        window.addEventListener("scroll", () => {
            scrollBtn.classList.toggle("hidden", window.scrollY <= 400);
        });
        scrollBtn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    </script>
</body>

</html>