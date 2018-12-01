<template>
  <div>
    <Countdown deadline="August 22, 2022, 11:40:00"></Countdown>

  </div>
</template>
<script>
//  <Countdown end="August 22, 2022"></Countdown>
import Countdown from 'vuejs-countdown'

export default {
  components: { Countdown }
}
</script>