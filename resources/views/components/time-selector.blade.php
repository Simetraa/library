@props(["label", "name", "topSellingItemsPeriod"])

<form action="/dashboard">
    <label for="{{ $name }}">{{ $label }}</label>
    <select name="{{ $name }}" onchange='this.form.submit()'>
        @php
            use Carbon\Carbon;
            use Carbon\CarbonPeriod;

            function makePeriodString(CarbonPeriod $period): string
            {
                return $period->getStartDate()->format("Y-m-d") . "-" . $period->getEndDate()->format("Y-m-d");
            }

            $yesterday = Carbon::yesterday();
            $lastWeek = Carbon::now()->subWeek();
            $lastMonth = Carbon::now()->subMonth();
            $lastYear = Carbon::now()->subYear();

            $now = CarbonPeriod::create(now(), now());
            $yesterday = CarbonPeriod::create($yesterday, $yesterday);
            $thisWeek = CarbonPeriod::create(now()->startOfWeek(), now()->endOfWeek());
            $thisMonth = CarbonPeriod::create(now()->startOfMonth(), now()->endOfMonth());
            $thisYear = CarbonPeriod::create(now()->startOfYear(), now()->endOfYear());
            // we need to create a clone of the last period to avoid modifying the original object
            $prevWeek = CarbonPeriod::create($lastWeek->copy()->startOfWeek(), $lastWeek->copy()->endOfWeek());
            $prevMonth = CarbonPeriod::create($lastMonth->copy()->startOfMonth(), $lastMonth->copy()->endOfMonth());
            $prevYear = CarbonPeriod::create($lastYear->copy()->startOfYear(), $lastYear->copy()->endOfYear());


            $todayString = makePeriodString($now);
            $yesterdayString = makePeriodString($yesterday);
            $thisWeekString = makePeriodString($thisWeek);
            $thisMonthString = makePeriodString($thisMonth);
            $thisYearString = makePeriodString($thisYear);
            $prevWeekString = makePeriodString($prevWeek);
            $prevMonthString = makePeriodString($prevMonth);
            $prevYearString = makePeriodString($prevYear);

            $topSellingItemsPeriod = $topSellingItemsPeriod ?? $todayString;

            $selectValues = [
                ["Today", $todayString],
                ["Yesterday", $yesterdayString],
                ["This Week", $thisWeekString],
                ["This Month", $thisMonthString],
                ["This Year", $thisYearString],
                ["Previous Week", $prevWeekString],
                ["Previous Month", $prevMonthString],
                ["Previous Year", $prevYearString]
                ]
        @endphp

        @foreach($selectValues as $value)
            <option value="{{ $value[1] }}" {{ $value[1] == $topSellingItemsPeriod ? "selected" : "" }}>{{ $value[0] }}</option>
        @endforeach
    </select>
</form>
