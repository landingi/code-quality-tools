# Landingi Code Quality Tools

Repository with customized code quality checks tools. This is still POC so any changes appreciated!

## Usage
### quality:coverage-validate

Currently, supports coverage report formats:
- Clover (`--coverage-clover-path PATH`)

Currently, supports validations:
- Crap (`--crap-threshold THRESHOLD`)
  - Crap index per method

Some projects already have this as `dev-dependency` so it is probably included into `composer.json` scripts.
There is also possibility to run it through docker image e.g: `docker run --rm -v $(pwd):/project FILL_WITH_IMAGE:latest quality:coverage-validate --coverage-clover-path=resources/coverage/crap/crappy_test_object.xml --crap-threshold 5`

Example output:
```
[ERROR] Landingi\QualityTools\Coverage\Validator\CrapIndex\MethodCrapIndexValid
         ator -> (                                                              
                Landingi\QualityTools\Console\CoverageValidatorCommand:execute ::     
         Maximum crap index (5) threshold has been reached. Current method crap 
         index is: (42)!                                                        
                Landingi\QualityTools\Coverage\Test\CrappyTestObject:executeCrappyCode
         :: Maximum crap index (5) threshold has been reached. Current method   
         crap index is: (42)!                                                   
         )                                                                      
```
