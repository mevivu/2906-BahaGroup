document.querySelectorAll('.truck-button').forEach(button => {
    button.addEventListener('click', e => {
                    e.preventDefault();

                    let box = button.querySelector('.box'),
                                    truck = button.querySelector('.truck');

                    if (!button.classList.contains('done')) {

                                    if (!button.classList.contains('animation')) {

                                                    button.classList.add('animation');

                                                    // Initial animations for the button and box
                                                    gsap.to(button, {
                                                                    '--box-s': 1,
                                                                    '--box-o': 1,
                                                                    duration: .3,
                                                                    delay: .5
                                                    });

                                                    gsap.to(box, {
                                                                    x: 0,
                                                                    duration: .4,
                                                                    delay: .7
                                                    });

                                                    gsap.to(button, {
                                                                    '--hx': -5,
                                                                    '--bx': 50,
                                                                    duration: .18,
                                                                    delay: .92
                                                    });

                                                    gsap.to(box, {
                                                                    y: 0,
                                                                    duration: .1,
                                                                    delay: 1.15
                                                    });

                                                    gsap.set(button, {
                                                                    '--truck-y': 0,
                                                                    '--truck-y-n': -26
                                                    });

                                                    // Calculate button and truck widths to set truck movement distance
                                                    const buttonWidth = button.offsetWidth;
                                                    const truckWidth = truck.offsetWidth;
                                                    const finalPosition = buttonWidth - truckWidth; // Stop at the edge

                                                    gsap.to(button, {
                                                                    '--truck-y': 1,
                                                                    '--truck-y-n': -25,
                                                                    duration: .2,
                                                                    delay: 1.25,
                                                                    onComplete() {
                                                                                    gsap.timeline({
                                                                                                                    onComplete() {
                                                                                                                                    button.classList.add('done');
                                                                                                                                    // Submit the form when the animation completes
                                                                                                                                    setInterval(() => {
                                                                                                                                                    button.closest('form').submit();
                                                                                                                                    }, 1000);
                                                                                                                    }
                                                                                                    })
                                                                                                    .to(truck, {
                                                                                                                    x: 0,
                                                                                                                    duration: .4
                                                                                                    })
                                                                                                    .to(truck, {
                                                                                                                    x: finalPosition * 0.6,
                                                                                                                    duration: 1
                                                                                                    }) // Move 60% across
                                                                                                    .to(truck, {
                                                                                                                    x: finalPosition * 0.8,
                                                                                                                    duration: .6
                                                                                                    }) // Move 80% across
                                                                                                    .to(truck, {
                                                                                                                    x: finalPosition,
                                                                                                                    duration: .4
                                                                                                    }); // Stop at edge

                                                                                    gsap.to(button, {
                                                                                                    '--progress': 1,
                                                                                                    duration: 2.4,
                                                                                                    ease: "power2.in"
                                                                                    });
                                                                    }
                                                    });
                                    }

                    } else {
                                    // Reset animations
                                    button.classList.remove('animation', 'done');
                                    gsap.set(truck, {
                                                    x: 4
                                    });
                                    gsap.set(button, {
                                                    '--progress': 0,
                                                    '--hx': 0,
                                                    '--bx': 0,
                                                    '--box-s': .5,
                                                    '--box-o': 0,
                                                    '--truck-y': 0,
                                                    '--truck-y-n': -26
                                    });
                                    gsap.set(box, {
                                                    x: -24,
                                                    y: -6
                                    });
                    }
    });
});
