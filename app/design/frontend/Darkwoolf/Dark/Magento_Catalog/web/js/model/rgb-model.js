define(
    ['ko'],
    function (ko) {
        'use strict';

        let red = ko.observable(0);
        let blue = ko.observable(0);
        let green = ko.observable(0);

        /**
         * @returns {number}
         */
        function randomNumber() {
            return Math.floor((Math.random() * 255) + 1);
        }

        /**
         * Set numbers for colors
         */
        function updateColour() {
            red(randomNumber());
            blue(randomNumber());
            green(randomNumber());
        }

        return {
            randomNumber: randomNumber,
            updateColour: updateColour,
            red: red,
            blue: blue,
            green: green
        };
    }
);
