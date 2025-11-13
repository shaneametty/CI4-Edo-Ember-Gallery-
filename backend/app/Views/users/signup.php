<!DOCTYPE html>
<html lang="en">

<head>
    <?= view('components/head', ['title' => '🔥 Sign Up']) ?>
</head>

<body class="flex justify-center items-center bg-[var(--accent)] min-h-screen font-sans">

    <div class="flex md:flex-row flex-col shadow-2xl rounded-3xl w-full max-w-6xl overflow-hidden">

        <div class="flex flex-col md:flex-1 justify-center bg-black/70 p-10" style="background: linear-gradient(90deg, var(--accent), #1c1c1cff);">
            <h2 class="mb-2 font-bold text-[var(--secondary)] text-3xl md:text-4xl">Create Account</h2>
            <p class="mb-6 text-[var(--neutral)]/80">Join Edo Ember Gallery today!</p>

            <!-- Error Messages -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="bg-red-500/20 border border-red-500 text-red-500 px-4 py-3 rounded-lg mb-4">
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <!-- Validation Errors -->
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="bg-red-500/20 border border-red-500 rounded-lg p-4 mb-4">
                    <ul class="list-disc list-inside text-red-500">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form class="flex flex-col gap-4" action="/signup" method="post">
                <input type="text"
                    name="first_name"
                    placeholder="First Name"
                    value="<?= old('first_name') ?>"
                    class="bg-[#1b1b1b] px-4 py-2 border border-[var(--secondary)] rounded-lg focus:outline-none text-[var(--neutral)]"
                    required>

                <input type="text"
                    name="middle_name"
                    placeholder="Middle Name (Optional)"
                    value="<?= old('middle_name') ?>"
                    class="bg-[#1b1b1b] px-4 py-2 border border-[var(--secondary)] rounded-lg focus:outline-none text-[var(--neutral)]">

                <input type="text"
                    name="last_name"
                    placeholder="Last Name"
                    value="<?= old('last_name') ?>"
                    class="bg-[#1b1b1b] px-4 py-2 border border-[var(--secondary)] rounded-lg focus:outline-none text-[var(--neutral)]"
                    required>

                <input type="email"
                    name="email"
                    placeholder="Email"
                    value="<?= old('email') ?>"
                    class="bg-[#1b1b1b] px-4 py-2 border border-[var(--secondary)] rounded-lg focus:outline-none text-[var(--neutral)]"
                    required>

                <input type="password"
                    name="password"
                    placeholder="Password (min 6 characters)"
                    class="bg-[#1b1b1b] px-4 py-2 border border-[var(--secondary)] rounded-lg focus:outline-none text-[var(--neutral)]"
                    required
                    minlength="6">

                <button type="submit"
                    class="hover:bg-[var(--primary)] hover:shadow-[0_0_15px_var(--primary)] py-2 border-[var(--primary)] border-2 rounded-lg font-bold text-[var(--primary)] hover:text-[var(--neutral)] transition">
                    Sign Up
                </button>

                <div class="flex items-center my-4 text-[var(--secondary)] text-sm divider">
                    <span class="flex-1 border-[var(--secondary)] border-b"></span>
                    <span class="mx-2">or access quickly with</span>
                    <span class="flex-1 border-[var(--secondary)] border-b"></span>
                </div>

                <div class="flex justify-center gap-4">
                    <img src="https://cdn-icons-png.flaticon.com/512/281/281764.png" alt="Google"
                        class="w-10 h-10 hover:scale-110 transition cursor-pointer">
                    <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook"
                        class="w-10 h-10 hover:scale-110 transition cursor-pointer">
                </div>

                <p class="mt-6 text-[var(--neutral)]/70 text-center">
                    Already have an account? <a href="/login"
                        class="font-semibold text-[var(--secondary)] hover:underline">Log In</a> |
                    <a href="/" class="font-semibold text-[var(--secondary)] hover:underline">Back to Home</a>
                </p>
            </form>
        </div>

        <div class="hidden md:block relative md:flex-1 bg-cover bg-center"
            style="background-image: url('https://i.pinimg.com/736x/7d/18/05/7d1805bba729d4ea2eca7d79eb543f09.jpg');">
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="absolute inset-0 flex flex-col justify-center items-center px-8 text-center">
                <h2 class="mb-4 font-bold text-[var(--neutral)] text-4xl">🔥 Edo Ember Gallery</h2>
                <p class="text-[var(--neutral)]/80">Bringing classic brushwork to the digital age.</p>
            </div>
        </div>

    </div>

</body>

</html>