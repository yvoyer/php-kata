# Contributing

PHPKata is an open source. If you'd like to contribute, you are welcome to do so,
but remember to follow these few simple rules:

## Branching strategy

- All new changes __MUST__ be based on the `master` branch.
- When you create a Pull Request, always select `master` branch as target.

## Kata Suggestion

- When submitting a new kata, __ALWAYS__ name your branch `kata/{kata-name}` (ie. `kata/my-cool-kata`.

## Coverage

- All bugfix must come with a set of PHPUnit tests.
- All new features that improves the framework must be covered by Behat tests.
- All new kata addition, must be covered by `.phpt` tests in the `tests/Regressions` folder

## Code style / Formatting

- All new classes must carry the standard copyright notice docblock
- All code in the `lib` folder must follow the [PSR-2](http://www.php-fig.org/psr/psr-2/) standard
- All test methods in the `tests/PHPUnit` must be in [snake_case_format](https://en.wikipedia.org/wiki/Snake_case)

__Note: Any suggestions is always welcome, don't hesitate, and welcome.__
