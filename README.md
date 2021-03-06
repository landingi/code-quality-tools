# Landingi Code Quality Tools
[![Build Status](https://travis-ci.com/landingi/crap-metric-analyzer.svg?branch=master)](https://travis-ci.com/landingi/crap-metric-analyzer)
[![License MIT](https://img.shields.io/apm/l/vim-mode.svg)](https://opensource.org/licenses/MIT)
[![Packagist Version](https://img.shields.io/packagist/v/landingi/crap-metric-analyzer)](https://packagist.org/packages/landingi/crap-metric-analyzer)

Repository with customized code quality checks tools. This is still POC so any changes appreciated!

The tool was created to support the maintenance of clean code by developers. The current functionality checks the quality of the code in terms of crap index.

## How to install?
```
composer require --dev landingi/crap-metric-analyzer
```

## How to contribute?

## Usage
### quality:coverage-validate

Currently, supports coverage report formats:
- Clover (`--coverage-clover-path PATH`)

Currently, supports validations:
- Crap (`--crap-threshold THRESHOLD`)
- Crap index per method

There is possibility to run it through docker image e.g: `docker run --rm -v $(pwd):/project FILL_WITH_IMAGE:latest quality:coverage-validate --coverage-clover-path=resources/coverage/crap/crappy_test_object.xml --crap-threshold 5`

Example output:
![alt text](resources/images/crap-index.png "Crap index validator violation output")
