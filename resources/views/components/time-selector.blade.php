@props(["label", "name"])

<form action="/dashboard">
    <label for="{{ $name }}">{{ $label }}</label>
    <select name="{{ $name }}" onchange='this.form.submit()'>
        @php
            use Carbon\Carbon;
            use Carbon\CarbonPeriod;
            use Carbon\Unit;

            function makePeriodString(CarbonPeriod $period): string
            {
                return $period->getStartDate()->format("Y-m-d") . "," . $period->getEndDate()->format("Y-m-d");
            }

            $yesterday = Carbon::yesterday();
            $lastWeek = Carbon::now()->subWeek();
            $lastMonth = Carbon::now()->subMonth();
            $lastYear = Carbon::now()->subYear();

            $now = CarbonPeriod::between(now(), now());
            $yesterday = CarbonPeriod::between(now(), now());
            $thisWeek = CarbonPeriod::between(now()->startOf(Unit::Week), now()->endOfWeek()); // no startOfWeek() method
            $thisMonth = CarbonPeriod::between(now()->startOfMonth(), now()->endOfMonth());
            $thisYear = CarbonPeriod::between(now()->startOfYear(), now()->endOfMonth());
            $prevWeek = CarbonPeriod::between($lastWeek->startOf(Unit::Week), $lastWeek->endOfWeek());
            $prevMonth = CarbonPeriod::between($lastMonth->startOfMonth(), $lastMonth->endOfMonth());
            $prevYear = CarbonPeriod::between($lastYear->startOfYear(), $lastYear->endOfYear());

            $todayString = makePeriodString($now);
            $yesterdayString = makePeriodString($yesterday);
            $thisWeekString = makePeriodString($thisWeek);
            $thisMonthString = makePeriodString($thisMonth);
            $thisYearString = makePeriodString($thisYear);
            $prevWeekString = makePeriodString($prevWeek);
            $prevMonthString = makePeriodString($prevMonth);
            $prevYearString = makePeriodString($prevYear);
        @endphp

        <option value="{{ $todayString }}">Today</option>
        <option value="{{ $yesterdayString }}">Yesterday</option>
        <option value="{{ $thisWeekString }}">This Week</option>
        <option value="{{ $thisMonthString }}">This Month</option>
        <option value="{{ $thisYearString }}">This Year</option>
        <option value="{{ $prevWeekString }}">Previous Week</option>
        <option value="{{ $prevMonthString }}">Previous Month</option>
        <option value="{{ $prevYearString }}">Previous Year</option>
    </select>
</form>
