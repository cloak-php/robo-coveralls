<?php

use cloak\robo\coveralls\Action;
use Prophecy\Prophet;
use Prophecy\Argument;


describe('Action', function() {
    describe('#configure', function() {
        beforeEach(function() {
            $this->configPath = __DIR__ . '/fixtures/coveralls.toml';
            $this->reportPath = __DIR__ . '/../tmp/build_coveralls.json';

            $template = file_get_contents(__DIR__ . '/fixtures/report.lcov');
            $reportContent = str_replace('{rootDirectory}', realpath(__DIR__ . '/../'), $template);
            file_put_contents(__DIR__ . '/../tmp/build_report.lcov', $reportContent);

            $this->prophat = new Prophet();

            $builder = $this->prophat->prophesize('coverallskit\ReportBuilderInterface');
            $this->action = new Action($builder->reveal());

            $builder->token('repo_token')->shouldBeCalled()->willReturn($builder);
            $builder->service(Argument::any())->shouldBeCalled()->willReturn($builder);
            $builder->repository(Argument::any())->shouldBeCalled()->willReturn($builder);
            $builder->reportFilePath(Argument::any())->shouldBeCalled();
            $builder->addSources(Argument::any())->shouldBeCalled();
        });
        it('configure report builder', function() {
            $this->action->configure($this->configPath);
            $this->prophat->checkPredictions();
        });
    });
    describe('#save', function() {
        beforeEach(function() {
            $this->configPath = __DIR__ . '/fixtures/coveralls.toml';
            $this->reportPath = __DIR__ . '/../tmp/build_coveralls.json';

            $template = file_get_contents(__DIR__ . '/fixtures/report.lcov');
            $reportContent = str_replace('{rootDirectory}', realpath(__DIR__ . '/../'), $template);
            file_put_contents(__DIR__ . '/../tmp/build_report.lcov', $reportContent);

            $this->prophat = new Prophet();

            $builder = $this->prophat->prophesize('coverallskit\ReportBuilderInterface');
            $this->action = new Action($builder->reveal());

            $report = $this->prophat->prophesize('coverallskit\entity\ReportInterface');
            $report->save();
            $report->saveAs();
            $report->upload();

            $builder->token('repo_token')->shouldBeCalled()->willReturn($builder);
            $builder->service(Argument::any())->shouldBeCalled()->willReturn($builder);
            $builder->repository(Argument::any())->shouldBeCalled()->willReturn($builder);
            $builder->reportFilePath(Argument::any())->shouldBeCalled();
            $builder->addSources(Argument::any())->shouldBeCalled();
            $builder->build()->shouldBeCalled()->willReturn($report->reveal());
        });
        it('save report', function() {
            $this->action->configure($this->configPath);
            $this->action->build();
            $this->action->save();
            $this->prophat->checkPredictions();
        });
    });

});
