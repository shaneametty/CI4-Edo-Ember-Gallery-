<!DOCTYPE html>
<html lang="en">

<head>
    <?= view('components/head', ['title' => '🔥 Login']) ?>
</head>

<body class="flex justify-center items-center bg-[var(--accent)] min-h-screen font-sans">

    <div class="flex md:flex-row flex-col shadow-2xl rounded-3xl w-full max-w-6xl overflow-hidden">

        <div class="hidden md:block relative md:flex-1 bg-cover bg-center"
            style="background-image: url('https://i.pinimg.com/1200x/12/7c/1a/127c1ae027fe838dd660ead4f8b77b6b.jpg');">
            <div class="absolute inset-0 bg-black/50"></div>
            <div class="absolute inset-0 flex flex-col justify-center items-center px-8 text-center">
                <h2 class="mb-4 font-bold text-[var(--neutral)] text-4xl">Edo Ember Gallery</h2>
                <p class="text-[var(--neutral)]/80">Bringing classic brushwork to the digital age.</p>
            </div>
        </div>

        <div class="flex flex-col md:flex-1 justify-center p-10"
            style="background: linear-gradient(90deg, #1c1c1cff, var(--accent));">
            <h2 class="mb-2 font-bold text-[var(--secondary)] text-3xl md:text-4xl">Welcome Back!</h2>
            <p class="mb-6 text-[var(--neutral)]/80">Log in to your account</p>

            <!-- Success Message -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="bg-green-500/20 border border-green-500 text-green-500 px-4 py-3 rounded-lg mb-4">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <!-- Error Message -->
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

            <form class="flex flex-col gap-4" action="/login" method="post">
                <input type="text" 
                       name="email" 
                       placeholder="Email" 
                       value="<?= old('email') ?>"
                       class="bg-[#1b1b1b] px-4 py-2 border border-[var(--secondary)] rounded-lg focus:outline-none text-[var(--neutral)]">
                
                <input type="password" 
                       name="password" 
                       placeholder="Password" 
                       class="bg-[#1b1b1b] px-4 py-2 border border-[var(--secondary)] rounded-lg focus:outline-none text-[var(--neutral)]">

                <div class="mb-4 text-right">
                    <a href="#" class="text-[var(--secondary)] text-sm hover:underline">Forgot password?</a>
                </div>

                <button type="submit" class="hover:bg-[var(--primary)] hover:shadow-[0_0_15px_var(--primary)] py-2 border-[var(--primary)] border-2 rounded-lg font-bold text-[var(--primary)] hover:text-[var(--neutral)] transition">
                    Log In
                </button>

                <div class="flex items-center my-4 text-[var(--secondary)] text-sm divider">
                    <span class="flex-1 border-[var(--secondary)] border-b"></span>
                    <span class="mx-2">or access quickly with</span>
                    <span class="flex-1 border-[var(--secondary)] border-b"></span>
                </div>

                <div class="flex justify-center gap-4">
                    <img src="https://cdn-icons-png.flaticon.com/512/281/281764.png" alt="Google" class="w-10 h-10 hover:scale-110 transition cursor-pointer">
                    <img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" alt="Facebook" class="w-10 h-10 hover:scale-110 transition cursor-pointer">
                </div>

                <p class="mt-6 text-[var(--neutral)]/70 text-center">
                    Don't have an account? <a href="/signup" class="font-semibold text-[var(--secondary)] hover:underline">Sign Up</a><br>
                    <a href="/" class="font-semibold text-[var(--secondary)] hover:underline">Back to Home</a>
                </p>
            </form>
        </div>

    </div>
</body>

</html>