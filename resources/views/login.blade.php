<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Login Sarpras</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        animation: {
                            'float': 'float 3s ease-in-out infinite',
                            'fade-in': 'fadeIn 0.5s ease-out',
                            'shake': 'shake 0.5s linear'
                        },
                        keyframes: {
                            float: {
                                '0%, 100%': { transform: 'translateY(0)' },
                                '50%': { transform: 'translateY(-10px)' },
                            },
                            fadeIn: {
                                '0%': { opacity: '0', transform: 'translateY(10px)' },
                                '100%': { opacity: '1', transform: 'translateY(0)' },
                            },
                            shake: {
                                '0%, 100%': { transform: 'translateX(0)' },
                                '10%, 30%, 50%, 70%, 90%': { transform: 'translateX(-5px)' },
                                '20%, 40%, 60%, 80%': { transform: 'translateX(5px)' },
                            }
                        }
                    }
                }
            }
        </script>
        <style>
            .input-highlight {
                transition: all 0.3s ease;
                box-shadow: 0 0 0 0px rgba(59, 130, 246, 0);
            }
            .input-highlight:focus {
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
            }
            .btn-glow:hover {
                box-shadow: 0 0 15px rgba(59, 130, 246, 0.6);
            }
        </style>
    </head>
    <body class="flex items-center justify-center min-h-screen bg-gray-100" style="background-image: url('{{ asset('asset/gedungstb.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="absolute inset-0 bg-black/50 backdrop-blur z-0"></div>

        <!-- Floating particles for visual interest -->
        <div class="absolute inset-0 overflow-hidden z-0">
            <div class="absolute top-1/4 left-1/4 w-3 h-3 bg-white/30 rounded-full animate-float animation-delay-100"></div>
            <div class="absolute top-1/3 right-1/3 w-2 h-2 bg-white/40 rounded-full animate-float animation-delay-300"></div>
            <div class="absolute bottom-1/4 right-1/4 w-4 h-4 bg-white/20 rounded-full animate-float animation-delay-500"></div>
            <div class="absolute bottom-1/3 left-1/3 w-3 h-3 bg-white/30 rounded-full animate-float animation-delay-700"></div>
        </div>

        <div class="w-full max-w-sm bg-white/90 rounded-lg shadow-xl p-8 relative z-10 mx-auto backdrop-blur-sm transform transition-all duration-300 hover:shadow-2xl animate-fade-in">
            <div class="flex flex-col items-center justify-center gap-3 mb-8">
                <img src="{{ asset('asset/logotb.png') }}" alt="Logo SARPRAS" class="h-14 w-auto transform transition-all duration-500 hover:scale-110">
                <h2 class="text-2xl font-bold text-gray-800 bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">SISFO SARPRAS</h2>
                <p class="text-sm text-gray-600 mt-1">Silakan masuk dengan akun Anda</p>
            </div>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm animate-shake">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <strong class="font-semibold">Terjadi kesalahan:</strong>
                    </div>
                    <div class="mt-1">
                        @foreach($errors->all() as $err)
                            <p>{{ $err }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input type="email" name="email" placeholder="Email"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none input-highlight"
                        required
                        onfocus="this.parentElement.querySelector('div').classList.add('text-blue-500')"
                        onblur="this.parentElement.querySelector('div').classList.remove('text-blue-500')"/>
                </div>

                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fas fa-lock"></i>
                    </div>
                    <input type="password" name="password" placeholder="Kata Sandi"
                        class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md focus:outline-none input-highlight"
                        required
                        onfocus="this.parentElement.querySelector('div').classList.add('text-blue-500')"
                        onblur="this.parentElement.querySelector('div').classList.remove('text-blue-500')"/>
                    <button type="button" class="absolute right-3 top-2 text-gray-400 hover:text-gray-600" onclick="togglePassword(this)">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Ingat saya</label>
                    </div>
                    <a href="#" class="text-sm text-blue-600 hover:text-blue-800 hover:underline">Lupa password?</a>
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-2 rounded-md cursor-pointer transition duration-300 btn-glow transform hover:scale-[1.01] active:scale-[0.99]">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center text-sm text-gray-600">
                <p>web sistem informasi <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 hover:underline">SARPRAS</a></p>
            </div>
        </div>

        <script>
            function togglePassword(button) {
                const input = button.parentElement.querySelector('input');
                const icon = button.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            }

            // Add ripple effect to button
            document.querySelector('button[type="submit"]').addEventListener('click', function(e) {
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                const ripple = document.createElement('span');
                ripple.className = 'ripple-effect';
                ripple.style.left = `${x}px`;
                ripple.style.top = `${y}px`;

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 1000);
            });
        </script>
    </body>
</html>
