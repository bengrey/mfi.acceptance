@rem запуск исполнения chromedriver

@rem cd C:\Users\Misha
@rem chromedriver --url-base=wd/hub/ 

@rem переход в папку с qa
@rem cd E:\QA

@rem переход в папку тестов
cd E:\OSPanel\domains\devtest

php codecept.phar run acceptance

pause